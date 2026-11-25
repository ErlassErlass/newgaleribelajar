@extends('layouts.app')

@php
    $shopee = config('erlass.shopee');
    $label = collect([$channel === 'shopee' ? __('Tersedia di Shopee') : ($channel === 'lms' ? __('Platform LMS') : null), ($activeCategory?->name ? __($activeCategory->name) : null), $level ? __('Jenjang :level', ['level' => $level]) : null, $type ? ($type === 'fisik' ? __('Produk Fisik') : __('Program & Layanan')) : null])->filter()->implode(' · ');
    $pageTitle = $label
        ? __(':label – Katalog Produk Erlass Academy', ['label' => $label])
        : __('Katalog Produk Coding, Robotika, Micro:bit & Modul Sekolah | Erlass Academy');
    $pageDesc = $label
        ? __('Katalog :label dari Erlass Academy: program, modul, dan perangkat pembelajaran teknologi untuk sekolah. Pesan via konsultasi atau Shopee resmi Erlass.', ['label' => $label])
        : __('Katalog lengkap :count produk Erlass Academy: ekskul coding Scratch, robotika, Micro:bit, Pictoblox AI, modul Scratch & LKPD, LMS, dan asesmen bakat untuk SD, SMP, SMA.', ['count' => $totalProducts]);
    $canonical = url()->current().(($p = http_build_query(array_filter([
        'kategori' => $activeCategory?->slug,
        'jenjang' => $level,
        'jenis' => $type,
        'tersedia' => $channel,
        'page' => $products->currentPage() > 1 ? $products->currentPage() : null,
    ]))) ? '?'.$p : '');
    $filterUrl = fn (array $override) => route('products.index', array_filter(array_merge([
        'kategori' => $activeCategory?->slug, 'jenjang' => $level, 'jenis' => $type, 'tersedia' => $channel,
        'urut' => $sort !== 'populer' ? $sort : null, 'q' => $search ?: null,
    ], $override)));

    // Answer-first FAQ: shown on the page and mirrored as FAQPage schema (SEO rich result + GEO citations)
    // Questions are managed in admin (Katalog > Pertanyaan (FAQ) > Seputar Katalog)
    $faqVars = [
        '{total_produk}' => $totalProducts,
        '{kategori_katalog}' => $categories->where('products_count', '>', 0)->pluck('name')->map(fn ($x) => __($x))->implode(', '),
        '{whatsapp}' => config('erlass.phone_display'),
        '{shopee}' => $shopee,
    ];
    $faqs = $catalogFaqs->map(fn ($f) => [\App\Models\Faq::render(__($f->question), $faqVars), \App\Models\Faq::render(__($f->answer), $faqVars)])->all();
@endphp

@section('title', $pageTitle)
@section('description', $pageDesc)
@section('keywords', __('katalog erlass, modul scratch, ekskul coding sekolah, microbit learning kit, robotik explorer, pictoblox ai, lkpd tik, lms sekolah, shopee erlass'))
@section('canonical', $canonical)
@if($search !== '' || $sort !== 'populer')
    @section('robots', 'noindex, follow')
@endif

@push('head')
    @if($products->previousPageUrl())<link rel="prev" href="{{ $products->previousPageUrl() }}">@endif
    @if($products->nextPageUrl())<link rel="next" href="{{ $products->nextPageUrl() }}">@endif
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => array_values(array_filter([
            [
                '@type' => 'CollectionPage',
                'name' => $pageTitle,
                'description' => $pageDesc,
                'url' => $canonical,
                'inLanguage' => 'id-ID',
                'isPartOf' => ['@type' => 'WebSite', 'name' => 'Erlass Academy', 'url' => route('home')],
                'mainEntity' => [
                    '@type' => 'ItemList',
                    'numberOfItems' => $products->total(),
                    'itemListElement' => $products->values()->map(fn ($p, $i) => [
                        '@type' => 'ListItem',
                        'position' => $products->firstItem() + $i,
                        'url' => route('products.show', $p->slug),
                        'name' => $p->name.' ('.$p->sku.')',
                        'image' => $p->cover_url,
                    ])->all(),
                ],
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => array_values(array_filter([
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Katalog Produk', 'item' => route('products.index')],
                    $activeCategory ? ['@type' => 'ListItem', 'position' => 3, 'name' => $activeCategory->name, 'item' => route('products.index', ['kategori' => $activeCategory->slug])] : null,
                ])),
            ],
            $faqs ? [
                '@type' => 'FAQPage',
                'mainEntity' => collect($faqs)->map(fn ($f) => [
                    '@type' => 'Question',
                    'name' => $f[0],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
                ])->all(),
            ] : null,
        ])),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
<section class="relative bg-gradient-to-br from-[#dff2fa] via-white to-[#fff2d4] text-[#023047] border-b border-[#8ecae6]/40 pt-16 sm:pt-20 pb-14 sm:pb-16 overflow-hidden">
    <div class="absolute inset-0 hero-grid-pattern opacity-40 pointer-events-none"></div>
    <div class="absolute -left-24 -bottom-24 w-80 h-80 rounded-full bg-[#8ecae6]/30 blur-3xl pointer-events-none"></div>
    <div class="absolute -right-24 -top-24 w-80 h-80 rounded-full bg-[#fb8500]/20 blur-3xl pointer-events-none"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
        <nav aria-label="Breadcrumb" class="text-xs sm:text-sm">
            <ol class="inline-flex items-center gap-2 text-slate-500">
                <li><a href="{{ route('home') }}" class="hover:text-[#219ebc]">{{ __('Beranda') }}</a></li>
                <li aria-hidden="true">/</li>
                @if($activeCategory)
                <li><a href="{{ route('products.index') }}" class="hover:text-[#219ebc]">{{ __('Katalog') }}</a></li>
                <li aria-hidden="true">/</li>
                <li class="text-[#219ebc]" aria-current="page">{{ __($activeCategory->name) }}</li>
                @else
                <li class="text-[#219ebc]" aria-current="page">{{ __('Katalog Produk') }}</li>
                @endif
            </ol>
        </nav>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">{{ $activeCategory?->name ? __($activeCategory->name) : __('Katalog Produk Erlass') }}</h1>
        <p class="text-slate-600 max-w-2xl mx-auto text-sm sm:text-base">
            {{ $activeCategory?->description ? __($activeCategory->description) : __('Program ekskul, modul belajar, dan perangkat Coding, Robotika & Micro:bit yang dipakai 400+ sekolah mitra di Indonesia.') }}
        </p>

        <form action="{{ route('products.index') }}" method="GET" role="search" class="relative max-w-xl mx-auto pt-2">
            @if($activeCategory)<input type="hidden" name="kategori" value="{{ $activeCategory->slug }}">@endif
            <label for="product-search" class="sr-only">{{ __('Cari produk') }}</label>
            <input id="product-search" type="search" name="q" value="{{ $search }}" placeholder="{{ __('Cari produk atau kode, mis. Modul Scratch, MLK01...') }}"
                   class="w-full h-13 rounded-full bg-white pl-12 pr-28 text-sm sm:text-base text-slate-800 placeholder:text-slate-400 outline-none ring-1 ring-[#8ecae6] shadow-sm focus:ring-[#8ecae6]/50">
            <svg class="absolute left-4 top-1/2 mt-1 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
            <button type="submit" class="absolute right-1.5 top-1/2 mt-1 -translate-y-1/2 h-10 px-5 rounded-full bg-[#fb8500] hover:bg-[#e07600] text-white text-sm font-bold transition-colors">{{ __('Cari') }}</button>
        </form>
    </div>
</section>

<section class="relative py-12 sm:py-16 bg-slate-50 overflow-hidden">
    @include('partials.side-decor')

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Category tabs --}}
        <nav class="flex gap-2 mb-5 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap sm:overflow-visible" aria-label="{{ __('Filter kategori produk') }}">
            <a href="{{ $filterUrl(['kategori' => null, 'page' => null]) }}" class="shrink-0 px-4 py-2 rounded-full text-sm font-semibold border transition-colors {{ $activeCategory ? 'bg-white border-slate-200 text-slate-700 hover:border-[#219ebc]' : 'bg-[#023047] border-[#023047] text-white' }}">{{ __('Semua') }} <span class="opacity-60 text-xs">{{ $totalProducts }}</span></a>
            @foreach($categories as $cat)
                @continue($cat->products_count === 0)
                <a href="{{ $filterUrl(['kategori' => $cat->slug]) }}" class="shrink-0 px-4 py-2 rounded-full text-sm font-semibold border transition-colors {{ $activeCategory?->id === $cat->id ? 'bg-[#023047] border-[#023047] text-white' : 'bg-white border-slate-200 text-slate-700 hover:border-[#219ebc]' }}">{{ __($cat->name) }} <span class="opacity-60 text-xs">{{ $cat->products_count }}</span></a>
            @endforeach
        </nav>

        {{-- Sales channel --}}
        <div class="flex flex-wrap items-center gap-2 mb-4 text-sm">
            <span class="text-xs font-bold uppercase tracking-widest text-slate-400 mr-1">{{ __('Tersedia di') }}</span>
            @foreach(['' => __('Semua'), 'shopee' => 'Shopee Erlass', 'lms' => __('Platform LMS')] as $ck => $cl)
            <a href="{{ $filterUrl(['tersedia' => $ck ?: null]) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-semibold transition-colors {{ $channel === ($ck ?: null) ? ($ck === 'shopee' ? 'bg-[#ee4d2d] text-white' : 'bg-[#219ebc] text-white') : 'bg-white border border-slate-200 text-slate-600 hover:border-[#219ebc]' }}">
                @if($ck === 'shopee')@include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-4 h-4'])@endif
                {{ $cl }}
            </a>
            @endforeach
        </div>

        {{-- Secondary filters --}}
        <div class="flex flex-wrap items-center justify-between gap-3 mb-8">
            <div class="flex flex-wrap items-center gap-2 text-sm">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-400 mr-1">{{ __('Jenjang') }}</span>
                @foreach(array_merge([null], \App\Http\Controllers\ProductController::LEVELS) as $lv)
                <a href="{{ $filterUrl(['jenjang' => $lv]) }}" class="px-3 py-1.5 rounded-lg font-semibold transition-colors {{ $level === $lv ? 'bg-[#219ebc] text-white' : 'bg-white border border-slate-200 text-slate-600 hover:border-[#219ebc]' }}">{{ $lv ?? __('Semua') }}</a>
                @endforeach
                <span class="w-px h-6 bg-slate-200 mx-2 hidden sm:block"></span>
                @foreach(['' => __('Semua Jenis'), 'fisik' => __('Produk Fisik'), 'jasa' => __('Program')] as $tk => $tl)
                <a href="{{ $filterUrl(['jenis' => $tk ?: null]) }}" class="px-3 py-1.5 rounded-lg font-semibold transition-colors {{ $type === ($tk ?: null) ? 'bg-[#219ebc] text-white' : 'bg-white border border-slate-200 text-slate-600 hover:border-[#219ebc]' }}">{{ $tl }}</a>
                @endforeach
            </div>
            <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2 text-sm">
                @foreach(['kategori' => $activeCategory?->slug, 'jenjang' => $level, 'jenis' => $type, 'tersedia' => $channel, 'q' => $search ?: null] as $k => $v)
                    @if($v)<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endif
                @endforeach
                <label for="sort" class="text-slate-500">{{ __('Urutkan') }}</label>
                <select id="sort" name="urut" onchange="this.form.submit()" class="rounded-lg border-slate-200 bg-white px-3 py-1.5 font-semibold text-[#023047]">
                    @foreach(\App\Http\Controllers\ProductController::SORTS as $sk => $sl)
                    <option value="{{ $sk }}" @selected($sort === $sk)>{{ __($sl) }}</option>
                    @endforeach
                </select>
                <noscript><button class="px-3 py-1.5 rounded-lg bg-[#023047] text-white font-semibold">OK</button></noscript>
            </form>
        </div>

        @if($search !== '')
        <p class="-mt-4 mb-6 text-sm text-slate-500">Menampilkan {{ $products->total() }} hasil untuk <a href="{{ $filterUrl(['q' => null]) }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#023047] text-white font-semibold" aria-label="{{ __('Hapus pencarian') }}">“{{ $search }}” <span aria-hidden="true">✕</span></a></p>
        @endif

        @if($products->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl border border-slate-200">
                <p class="text-slate-700 font-semibold">{{ __('Produk tidak ditemukan.') }}</p>
                <p class="text-sm text-slate-500 mt-1">{{ __('Coba kata kunci lain atau') }} <a href="{{ route('products.index') }}" class="text-[#219ebc] font-semibold hover:underline">{{ __('lihat semua produk') }}</a>.</p>
            </div>
        @else
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($products as $product)
                    @include('products._card', ['product' => $product, 'eager' => $loop->index < 4])
                @endforeach
            </div>
            <div class="mt-10">{{ $products->links() }}</div>
        @endif

        {{-- Shopee band --}}
        <div class="mt-16 rounded-3xl bg-gradient-to-r from-[#ee4d2d] to-[#ff7337] p-6 sm:p-10 text-white grid grid-cols-1 md:grid-cols-[1fr_auto] gap-6 items-center relative overflow-hidden">
            <svg class="absolute -right-8 -bottom-10 w-52 h-52 text-white/10 pointer-events-none" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 7V6a5 5 0 0110 0v1h3l-1 15H5L4 7h3zm2 0h6V6a3 3 0 00-6 0v1z"/></svg>
            <div class="relative">
                <p class="text-xs font-bold uppercase tracking-wider text-white/80">{{ __('Toko Resmi') }}</p>
                <h2 class="text-xl sm:text-2xl font-extrabold mt-1">{{ __('Beli modul & learning kit Erlass satuan di Shopee') }}</h2>
                <p class="text-sm text-white/90 mt-2">{{ __('Modul Scratch, LKPD TIK, Micro:bit Learning Kit, dan kit robotika tersedia di toko Shopee resmi Erlass.') }}</p>
            </div>
            <a href="{{ $shopee }}" target="_blank" rel="noopener" class="relative inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white text-[#ee4d2d] font-bold shadow-md hover:-translate-y-0.5 transition-transform">
                @include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-5 h-5'])
                {{ __('Kunjungi Shopee Erlass') }}
            </a>
        </div>

        {{-- FAQ (answer-first content for search & AI engines) --}}
        @if($faqs)
        <div class="mt-16 max-w-3xl mx-auto">
            <h2 class="text-2xl font-extrabold text-[#023047] text-center mb-6">{{ __('Pertanyaan Seputar Katalog') }}</h2>
            <div class="space-y-3">
                @foreach($faqs as [$q, $a])
                <details class="group bg-white rounded-2xl border border-slate-200 p-5 open:shadow-sm">
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none font-bold text-[#023047] [&::-webkit-details-marker]:hidden">
                        <h3 class="text-base">{{ $q }}</h3>
                        <span class="text-[#219ebc] text-xl transition-transform group-open:rotate-45" aria-hidden="true">+</span>
                    </summary>
                    <p class="mt-3 text-sm text-slate-600 leading-relaxed">{{ $a }}</p>
                </details>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
