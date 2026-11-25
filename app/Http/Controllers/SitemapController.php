<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Product;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $static = [
            ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => route('products.index'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => route('articles.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => route('lms.index'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('gallery'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('privacy'), 'priority' => '0.2', 'changefreq' => 'yearly'],
            ['loc' => route('terms'), 'priority' => '0.2', 'changefreq' => 'yearly'],
        ];

        foreach (array_keys(\App\Models\ArticleCategory::options()) as $cat) {
            $static[] = ['loc' => route('articles.index', ['kategori' => $cat]), 'priority' => '0.5', 'changefreq' => 'weekly'];
        }

        foreach (Category::where('is_active', true)->whereHas('products', fn ($q) => $q->published())->pluck('slug') as $slug) {
            $static[] = ['loc' => route('products.index', ['kategori' => $slug]), 'priority' => '0.7', 'changefreq' => 'weekly'];
        }

        $products = Product::published()->uniqueTitles()->with('category')->orderByDesc('group_deals')->get();

        $articles = Article::published()->get(['slug', 'updated_at', 'cover_image', 'title']);

        return response()
            ->view('sitemap', compact('static', 'products', 'articles'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
