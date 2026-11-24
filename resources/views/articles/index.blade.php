@extends('layouts.app')

@php
    // Unique title/description per listing so category and hashtag pages can rank on their own
    $pageLabel = $activeTag ? '#'.$activeTag : ($activeCategory ? $categories[$activeCategory] : null);
    $pageTitle = $pageLabel ? $pageLabel.' - Artikel Erlass Academy' : 'Artikel, Berita & Kegiatan Coding dan Robotika | Erlass Academy';
    $pageDesc = $pageLabel
        ? 'Kumpulan artikel '.$pageLabel.' dari Erlass Academy: coding, robotika, Micro:bit, dan program pendidikan teknologi untuk sekolah.'
        : 'Berita, artikel, dokumentasi kegiatan, kompetisi coding & robotika, dan informasi program terbaru dari Erlass Academy.';
    // Canonical keeps the category/tag/page params but drops search
    $canonical = url()->current().(($p = http_build_query(array_filter(['kategori' => $activeCategory, 'tag' => $activeTag, 'page' => $articles->currentPage() > 1 ? $articles->currentPage() : null]))) ? '?'.$p : '');
@endphp

@section('title', $pageTitle)
@section('description', $pageDesc)
@section('canonical', $canonical)
@if($search !== '')
    @section('robots', 'noindex, follow')
@endif

@push('head')
    @if($articles->previousPageUrl())<link rel="prev" href="{{ $articles->previousPageUrl() }}">@endif
    @if($articles->nextPageUrl())<link rel="next" href="{{ $articles->nextPageUrl() }}">@endif
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => $pageTitle,
        'description' => $pageDesc,
        'url' => $canonical,
        'inLanguage' => 'id-ID',
        'mainEntity' => [
            '@type' => 'ItemList',
            'itemListElement' => $articles->values()->map(fn ($a, $i) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'url' => route('articles.show', $a->slug),
                'name' => $a->title,
            ])->all(),
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
<section class="relative bg-[#023047] text-white pt-16 sm:pt-20 pb-14 sm:pb-16 overflow-hidden">
    <div class="absolute inset-0 hero-grid-pattern opacity-40 pointer-events-none"></div>
    <div class="absolute -left-24 -bottom-24 w-80 h-80 rounded-full bg-[#219ebc]/25 blur-3xl pointer-events-none"></div>
    <div class="absolute -right-24 -top-24 w-80 h-80 rounded-full bg-[#fb8500]/20 blur-3xl pointer-events-none"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
        <nav aria-label="Breadcrumb" class="text-xs sm:text-sm">
            <ol class="inline-flex items-center gap-2 text-slate-400">
                <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                <li aria-hidden="true">/</li>
                <li class="text-[#8ecae6]" aria-current="page">Artikel</li>
            </ol>
        </nav>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">{{ $pageLabel ?? 'Aktivitas & Informasi Erlass' }}</h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-sm sm:text-base">Kompetisi, dokumentasi kegiatan, berita, dan informasi program terbaru dari Erlass Academy.</p>

        {{-- Search --}}
        <form action="{{ route('articles.index') }}" method="GET" role="search" class="relative max-w-xl mx-auto pt-2">
            @if($activeCategory)<input type="hidden" name="kategori" value="{{ $activeCategory }}">@endif
            <label for="article-search" class="sr-only">Cari artikel</label>
            <input id="article-search" type="search" name="q" value="{{ $search }}" placeholder="Cari artikel, topik, atau hashtag..."
                   class="w-full h-13 rounded-full bg-white pl-12 pr-28 text-sm sm:text-base text-slate-800 placeholder:text-slate-400 outline-none ring-4 ring-white/10 focus:ring-[#8ecae6]/50">
            <svg class="absolute left-4 top-1/2 mt-1 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
            <button type="submit" class="absolute right-1.5 top-1/2 mt-1 -translate-y-1/2 h-10 px-5 rounded-full bg-[#fb8500] hover:bg-[#e07600] text-white text-sm font-bold transition-colors">Cari</button>
        </form>
    </div>
</section>

<section class="relative py-12 sm:py-16 bg-slate-50 overflow-hidden">
    @include('partials.side-decor')

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex gap-2 mb-10 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap sm:overflow-visible" aria-label="Filter kategori artikel">
            <a href="{{ route('articles.index') }}" class="shrink-0 px-4 py-2 rounded-full text-sm font-semibold border transition-colors {{ $activeCategory ? 'bg-white border-slate-200 text-slate-700 hover:border-[#219ebc]' : 'bg-[#023047] border-[#023047] text-white' }}">Semua</a>
            @foreach($categories as $key => $label)
            <a href="{{ route('articles.index', ['kategori' => $key]) }}" class="shrink-0 px-4 py-2 rounded-full text-sm font-semibold border transition-colors {{ $activeCategory === $key ? 'bg-[#023047] border-[#023047] text-white' : 'bg-white border-slate-200 text-slate-700 hover:border-[#219ebc]' }}">{{ $label }}</a>
            @endforeach
        </nav>

        {{-- Active filters --}}
        @if($activeTag || $search !== '')
        <div class="flex flex-wrap items-center gap-2 -mt-6 mb-8 text-sm">
            <span class="text-slate-500">Menampilkan {{ $articles->total() }} hasil untuk</span>
            @if($activeTag)
            <a href="{{ route('articles.index', array_filter(['kategori' => $activeCategory, 'q' => $search ?: null])) }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#219ebc] text-white font-semibold" aria-label="Hapus filter hashtag">#{{ $activeTag }} <span aria-hidden="true">✕</span></a>
            @endif
            @if($search !== '')
            <a href="{{ route('articles.index', array_filter(['kategori' => $activeCategory, 'tag' => $activeTag])) }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#023047] text-white font-semibold" aria-label="Hapus pencarian">“{{ $search }}” <span aria-hidden="true">✕</span></a>
            @endif
        </div>
        @endif

        {{-- Popular hashtags --}}
        @if(!empty($popularTags))
        <div class="flex gap-2 mb-10 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap sm:overflow-visible" aria-label="Hashtag populer">
            <span class="shrink-0 self-center text-xs font-bold tracking-widest text-slate-400 uppercase mr-1">Hashtag Populer</span>
            @foreach($popularTags as $tag => $count)
            <a href="{{ route('articles.index', ['tag' => $tag]) }}" rel="tag" class="shrink-0 px-3 py-1.5 rounded-full text-sm font-semibold transition-colors {{ $activeTag === $tag ? 'bg-[#219ebc] text-white' : 'bg-[#8ecae6]/20 text-[#023047] hover:bg-[#219ebc] hover:text-white' }}">#{{ $tag }} <span class="opacity-60 text-xs">{{ $count }}</span></a>
            @endforeach
        </div>
        @endif

        @if($articles->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl border border-slate-200">
                <p class="text-slate-700 font-semibold">Artikel tidak ditemukan.</p>
                <p class="text-sm text-slate-500 mt-1">Coba kata kunci lain atau <a href="{{ route('articles.index') }}" class="text-[#219ebc] font-semibold hover:underline">lihat semua artikel</a>.</p>
            </div>
        @else
            @php
                // Every page leads with one large card (1 + 9 grid = 10 per page); pinned articles take it first
                $showFeatured = $articles->count() > 1 && !$activeTag && $search === '';
                $featured = $showFeatured ? $articles->first() : null;
                $rest = $showFeatured ? $articles->slice(1) : $articles;
            @endphp

            @if($featured)
            {{-- Featured article: pinned, otherwise the newest on this page --}}
            <a href="{{ route('articles.show', $featured->slug) }}" class="group grid grid-cols-1 lg:grid-cols-2 bg-white rounded-3xl border {{ $featured->is_pinned ? 'border-[#fb8500]/60 ring-1 ring-[#fb8500]/30' : 'border-slate-200/80' }} overflow-hidden shadow-sm hover:shadow-xl transition-shadow mb-10">
                <div class="aspect-[16/10] lg:aspect-auto lg:min-h-[340px] overflow-hidden bg-slate-100">
                    @if($featured->cover_image)
                    <img src="{{ asset($featured->cover_image) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @endif
                </div>
                <div class="p-6 sm:p-10 flex flex-col justify-center">
                    <div class="flex flex-wrap items-center gap-2 text-[11px] font-semibold mb-4">
                        @if($featured->is_pinned)
                        @include('articles._pin-badge')
                        @elseif($articles->onFirstPage())
                        <span class="px-2.5 py-1 rounded-md bg-[#ffb703] text-[#023047] uppercase tracking-wider">Terbaru</span>
                        @endif
                        <span class="px-2.5 py-1 rounded-md bg-[#8ecae6]/20 text-[#023047] uppercase tracking-wider">{{ $featured->category_label }}</span>
                        @if($featured->published_at)
                        <time datetime="{{ $featured->published_at->toDateString() }}" class="text-slate-500">{{ $featured->published_at->translatedFormat('d M Y') }}</time>
                        @endif
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#023047] leading-tight group-hover:text-[#219ebc] transition-colors">{{ $featured->title }}</h2>
                    <p class="text-slate-600 mt-3 leading-relaxed">{{ $featured->excerpt }}</p>
                    <span class="mt-6 text-sm font-bold text-[#219ebc]">Baca Selengkapnya →</span>
                </div>
            </a>
            @endif

            @if($rest->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rest as $article)
                    @include('articles._card', ['article' => $article])
                @endforeach
            </div>
            @endif

            <div class="mt-10">
                {{ $articles->links('partials.pagination') }}
            </div>
        @endif

        {{-- Follow Erlass --}}
        @php $social = config('erlass.social'); @endphp
        <div class="mt-16 rounded-3xl bg-gradient-to-r from-[#023047] to-[#219ebc] p-6 sm:p-10 text-white grid grid-cols-1 md:grid-cols-[1fr_auto] gap-6 items-center relative overflow-hidden">
            <svg class="absolute -right-6 -bottom-10 w-48 h-48 text-white/10 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l10 10-10 10L2 12z"/><path d="M12 7l5 5-5 5-5-5z"/></svg>
            <div class="relative">
                <p class="text-xs font-bold uppercase tracking-wider text-[#ffb703]">Ikuti Erlass</p>
                <h2 class="text-xl sm:text-2xl font-extrabold mt-1">Lihat dokumentasi kegiatan terbaru di media sosial kami</h2>
                <p class="text-sm text-slate-100 mt-2">Foto, video, dan cerita kegiatan coding & robotika dari sekolah mitra.</p>
            </div>
            <div class="relative flex flex-wrap gap-3">
                @foreach(['instagram' => 'Instagram', 'tiktok' => 'TikTok', 'youtube' => 'YouTube', 'facebook' => 'Facebook', 'facebook_group' => 'Grup Facebook'] as $key => $label)
                    @if(!empty($social[$key]))
                    <a href="{{ $social[$key] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }} Erlass" title="{{ $label }}" class="w-12 h-12 rounded-xl bg-white/15 hover:bg-white hover:text-[#023047] flex items-center justify-center transition-colors">
                        @include('partials.brand-icon', ['name' => $key, 'class' => 'w-5 h-5'])
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
