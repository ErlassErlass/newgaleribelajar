<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use App\Support\ProductCover;
use App\Support\SiteCache;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public const LEVELS = ['SD', 'SMP', 'SMA', 'SMK'];

    public const SORTS = [
        'populer' => 'Paling Populer',
        'terbaru' => 'Terbaru',
        'dilihat' => 'Paling Banyak Dilihat',
        'nama' => 'Nama A–Z',
    ];

    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Count titles, not rombel rows
        $titleCounts = Product::published()
            ->selectRaw('category_id, COUNT(DISTINCT name) as c')
            ->groupBy('category_id')
            ->pluck('c', 'category_id');
        $categories->each(fn ($c) => $c->products_count = (int) ($titleCounts[$c->id] ?? 0));

        $activeCategory = $categories->firstWhere('slug', $request->query('kategori'));

        $level = strtoupper((string) $request->query('jenjang'));
        $level = in_array($level, self::LEVELS, true) ? $level : null;

        $type = $request->query('jenis');
        $type = in_array($type, ['fisik', 'jasa'], true) ? $type : null;

        // Sales channel: shopee = sold on the Shopee store, lms = delivered on erlass.academy
        $channel = in_array($request->query('tersedia'), ['shopee', 'lms'], true) ? $request->query('tersedia') : null;

        $sort = array_key_exists((string) $request->query('urut'), self::SORTS) ? $request->query('urut') : 'populer';

        $search = trim(mb_substr((string) $request->query('q'), 0, 100));

        $products = Product::published()
            ->uniqueTitles()
            ->with('category')
            ->when($channel === 'shopee', fn ($q) => $q->where('on_shopee', true))
            ->when($channel === 'lms', fn ($q) => $q->where('on_lms', true))
            ->when($activeCategory, fn ($q) => $q->where('category_id', $activeCategory->id))
            ->when($level, fn ($q) => $q->whereJsonContains('education_levels', $level))
            ->when($type, fn ($q) => $q->where('product_type', $type === 'fisik' ? 'Fisik' : 'Jasa'))
            ->when($search !== '', function ($q) use ($search) {
                $like = '%'.addcslashes($search, '%_\\').'%';
                // Both languages, so visitors reading in English also find products
                $q->where(fn ($w) => $w->where('name', 'like', $like)
                    ->orWhere('name_en', 'like', $like)
                    ->orWhere('sku', 'like', $like)
                    ->orWhere('summary', 'like', $like)
                    ->orWhere('summary_en', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhere('description_en', 'like', $like));
            })
            ->when($sort === 'populer', fn ($q) => $q->orderByDesc('on_shopee')->orderByDesc('group_deals')->orderBy('sort_order'))
            ->when($sort === 'dilihat', fn ($q) => $q->orderByDesc('views')->orderByDesc('group_deals'))
            ->when($sort === 'terbaru', fn ($q) => $q->latest()->orderByDesc('id'))
            ->when($sort === 'nama', fn ($q) => $q->orderBy('name')->orderBy('sku'))
            ->paginate(12)
            ->withQueryString();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'level' => $level,
            'type' => $type,
            'channel' => $channel,
            'sort' => $sort,
            'search' => $search,
            'totalProducts' => Product::published()->distinct()->count('name'),
            'catalogFaqs' => SiteCache::remember('faq.catalog', 3600, fn () => Faq::where('scope', Faq::SCOPE_CATALOG)->active()->get(['question', 'answer'])),
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::published()->with('category')->where('slug', $slug)->firstOrFail();

        // Rombel rows (ECR01..ECR07 "Ekskul Coding Scratch") share one page: the lowest-id row is canonical
        $canonical = Product::published()->where('name', $product->getRawOriginal('name'))->orderBy('id')->first();
        if ($canonical->id !== $product->id) {
            return redirect()->route('products.show', $canonical->slug, 301);
        }
        $product->group_deals = Product::published()->where('name', $product->getRawOriginal('name'))->sum('deal_count');
        $hasRombel = Product::published()->where('name', $product->getRawOriginal('name'))->count() > 1;

        // One view per product per visitor session. Query-level increment: no model events, so the
        // page caches are not flushed on every visit.
        $seenKey = 'product_viewed_'.$product->id;
        if (! request()->session()->has($seenKey)) {
            Product::whereKey($product->id)->increment('views');
            $product->views++;
            request()->session()->put($seenKey, true);
        }

        $related = Product::published()
            ->uniqueTitles()
            ->with('category')
            ->where('category_id', $product->category_id)
            ->where('name', '!=', $product->name)
            ->orderByDesc('on_shopee')
            ->orderByDesc('group_deals')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'hasRombel', 'related'));
    }

    /** Generated SVG cover for products without a real photo. */
    public function cover(Request $request, string $sku)
    {
        $product = Product::published()->with('category')->where('sku', $sku)->firstOrFail();

        $svg = ProductCover::svg($product);
        $etag = '"'.md5($svg).'"';

        if ($request->header('If-None-Match') === $etag) {
            return response('', 304)->header('ETag', $etag);
        }

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=86400',
            'ETag' => $etag,
            'X-Robots-Tag' => 'noindex',
        ]);
    }
}
