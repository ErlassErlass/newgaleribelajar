<?php

namespace App\Http\Controllers;

use App\Models\LmsGroup;
use App\Models\Product;
use App\Support\SiteCache;

/** /lms — the Erlass Academy LMS products page linked from the navbar badge. */
class LmsController extends Controller
{
    public function __invoke()
    {
        // Same admin-managed columns as the homepage "Produk LMS" section; any admin edit flushes the cache.
        $data = SiteCache::remember('lms-page', 600, fn () => [
            'lmsGroups' => LmsGroup::active()
                ->where('slug', '!=', LmsGroup::BANNER)
                ->with(['products' => fn ($q) => $q->published()->with('category')])
                ->get()
                ->filter(fn ($group) => $group->products->isNotEmpty())
                ->values(),
            'resourceHub' => Product::published()->where('lms_group', LmsGroup::BANNER)->orderBy('lms_order')->first(),
        ]);

        return view('lms', $data);
    }
}
