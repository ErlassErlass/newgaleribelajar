<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Support\YoutubeFeed;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = config('gallery.categories', []);

        $category = array_key_exists((string) $request->query('kategori'), $categories) ? $request->query('kategori') : null;
        $sub = $category && array_key_exists((string) $request->query('sub'), $categories[$category]['subs'])
            ? $request->query('sub')
            : null;

        // Photo counts per category / sub-category for the filter chips
        $counts = Gallery::active()
            ->selectRaw('category, subcategory, COUNT(*) as c')
            ->groupBy('category', 'subcategory')
            ->get();
        $catCounts = $counts->groupBy('category')->map(fn ($rows) => $rows->sum('c'));
        $subCounts = $counts->where('category', $category)->pluck('c', 'subcategory');

        $photos = Gallery::active()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->when($sub, fn ($q) => $q->where('subcategory', $sub))
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $videos = YoutubeFeed::videos();

        return view('gallery', [
            'categories' => $categories,
            'category' => $category,
            'sub' => $sub,
            'photos' => $photos,
            'catCounts' => $catCounts,
            'subCounts' => $subCounts,
            'totalPhotos' => $catCounts->sum(),
            'videos' => $videos,
        ]);
    }
}
