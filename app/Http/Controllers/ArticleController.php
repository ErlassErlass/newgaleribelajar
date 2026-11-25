<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Support\SiteCache;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /** Articles per listing page; the rest are reached with the page links. */
    public const PER_PAGE = 10;

    public function index(Request $request)
    {
        $category = $request->query('kategori');
        if (! array_key_exists((string) $category, ArticleCategory::options())) {
            $category = null;
        }

        // Hashtag filter: letters/digits/underscore only (same shape as stored tags)
        $tag = ltrim((string) $request->query('tag'), '#');
        $tag = preg_match('/^[\pL\pN_]{1,50}$/u', $tag) ? $tag : null;

        $search = trim(mb_substr((string) $request->query('q'), 0, 100));

        $articles = Article::published()
            ->forCards()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->when($tag, fn ($q) => $q->withTag($tag))
            ->when($search !== '', function ($q) use ($search) {
                $like = '%'.addcslashes($search, '%_\\').'%';
                // Both languages, so visitors reading in English also find articles
                $q->where(fn ($w) => $w->where('title', 'like', $like)
                    ->orWhere('title_en', 'like', $like)
                    ->orWhere('excerpt', 'like', $like)
                    ->orWhere('excerpt_en', 'like', $like)
                    ->orWhere('body', 'like', $like)
                    ->orWhere('body_en', 'like', $like)
                    ->orWhere('tags', 'like', $like));
            })
            ->pinnedFirst()
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        return view('articles.index', [
            'articles' => $articles,
            'categories' => ArticleCategory::options(),
            'activeCategory' => $category,
            'activeTag' => $tag,
            'search' => $search,
            'popularTags' => $this->popularTags(),
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();

        // Count one view per article per session
        $seenKey = 'article_viewed_'.$article->id;
        if (! $request->session()->has($seenKey)) {
            Article::whereKey($article->id)->increment('views'); // no model events: keeps page caches intact
            $article->views++;
            $request->session()->put($seenKey, true);
        }

        $comments = $article->comments()
            ->approved()
            ->whereNull('parent_id')
            ->with('replies')
            ->latest()
            ->get();

        $commentCount = $article->comments()->approved()->count();

        // Related: same category first, then latest
        $related = Article::published()
            ->forCards()
            ->where('id', '!=', $article->id)
            ->orderByRaw('category = ? desc', [$article->category])
            ->take(3)
            ->get();

        return view('articles.show', [
            'article' => $article,
            'comments' => $comments,
            'commentCount' => $commentCount,
            'related' => $related,
            'previous' => $article->previousArticle(),
            'next' => $article->nextArticle(),
        ]);
    }

    /** @return array<string,int> tag => count, most used first */
    private function popularTags(int $limit = 12): array
    {
        // Reads every article's tags, so cache it: saving an article flushes SiteCache; the TTL picks up
        // scheduled articles that go live later.
        return SiteCache::remember('articles.popular-tags.'.$limit, 600, function () use ($limit) {
            $counts = [];
            Article::published()->pluck('tags')->each(function ($tags) use (&$counts) {
                foreach ((array) $tags as $t) {
                    $counts[$t] = ($counts[$t] ?? 0) + 1;
                }
            });
            arsort($counts);

            return array_slice($counts, 0, $limit, true);
        });
    }
}
