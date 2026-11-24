<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Article;
use App\Models\Category;
use App\Models\LmsGroup;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Program;
use App\Support\SiteCache;

class HomeController extends Controller
{
    public function __invoke()
    {
        // All homepage data in one cached bundle; any admin edit flushes it (see SiteCache).
        // The key includes this file's modification time, so a deploy that changes the bundle's
        // shape never serves an old cached bundle (which caused "Undefined variable $resourceHub").
        $data = SiteCache::remember('home.'.filemtime(__FILE__), 600, fn () => [
            'categories' => Category::where('is_active', true)->orderBy('sort_order')->get(['id', 'name', 'slug']),

            // Carousel: modules, kits & programs (one card per title); LMS products have their own section
            'featuredProducts' => Product::published()
                ->uniqueTitles()
                ->with('category')
                ->where('on_lms', false)
                ->where(fn ($q) => $q->where('is_featured', true)->orWhere('on_shopee', true))
                ->orderByDesc('on_shopee')
                ->orderByDesc('group_deals')
                ->take(12)
                ->get(),

            // "Produk Digital di LMS" section: admin-managed columns and the products placed in each
            'lmsGroups' => LmsGroup::active()
                ->with(['products' => fn ($q) => $q->published()->with('category')])
                ->get()
                ->filter(fn ($group) => $group->products->isNotEmpty())
                ->values(),
            'resourceHub' => Product::published()->where('lms_group', LmsGroup::BANNER)->orderBy('lms_order')->first(),

            'partners' => Partner::where('is_featured', true)->orderBy('sort_order')->get(),
            'allPartnerSchools' => Partner::where('type', 'school')->orderByDesc('total_deals')->take(40)->get(),
            'totalSchools' => Partner::count(),
            'totalDeals' => (int) Partner::sum('total_deals'),
            'programs' => Program::where('is_active', true)->get(),
            'latestArticles' => Article::published()->pinnedFirst()->take(4)->get(),
            'announcements' => Announcement::where('is_active', true)->latest()->take(4)->get(),
        ]);

        return view('welcome', $data);
    }
}
