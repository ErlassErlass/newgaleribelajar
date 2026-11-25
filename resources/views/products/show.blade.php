@extends('layouts.app')

@php
    $url = route('products.show', $product->slug);
    $category = $product->category;
    $erlass = config('erlass');
    $waText = rawurlencode("Halo Tim Erlass, saya ingin info / penawaran produk {$product->name} untuk sekolah kami.");
    $waUrl = 'https://wa.me/'.$erlass['whatsapp'].'?text='.$waText;
    $features = array_filter((array) $product->features);

    // Short, self-contained answer paragraph: the passage search & AI engines are most likely to quote
    $kind = $product->is_free ? __('layanan gratis')
        : ($product->on_lms ? __(':type (platform LMS Erlass Academy)', ['type' => strtolower(__($product->type_label))])
        : ($product->is_physical ? __('produk pembelajaran fisik') : __('program pembelajaran')));
    $answer = __(':name adalah :kind dari Erlass Academy dalam kategori :category untuk jenjang :levels.', [
            'name' => $product->name,
            'kind' => $kind,
            'category' => $category?->name ? __($category->name) : __('pendidikan teknologi'),
            'levels' => $product->levels_label,
        ])
        .($product->summary ? ' '.__($product->summary) : '')
        .($product->on_shopee ? ' '.__('Tersedia di toko Shopee resmi Erlass.') : '')
        .($product->total_deals > 0 ? ' '.__('Produk ini telah digunakan oleh :count+ sekolah mitra Erlass di Indonesia.', ['count' => $product->total_deals]) : '');

    // Pertanyaan Umum: managed in admin (template FAQ and/or this product's own questions)
    $faqs = $product->faqItems();

    $schemaProduct = array_filter([
        '@type' => $product->is_physical ? 'Product' : ['Product', 'Service'],
        '@id' => $url.'#product',
        'name' => $product->name,
        'sku' => $product->sku,
        'mpn' => $product->sku,
        'url' => $url,
        'image' => [$product->cover_url],
        'description' => trim(($product->summary ? $product->summary.' ' : '').$product->description),
        'category' => $category?->name,
        'brand' => ['@type' => 'Brand', 'name' => 'Erlass Academy'],
        'manufacturer' => ['@type' => 'Organization', 'name' => $erlass['company'], 'url' => route('home')],
        'audience' => ['@type' => 'EducationalAudience', 'educationalRole' => 'student', 'audienceType' => 'Siswa '.$product->levels_label],
        'additionalProperty' => array_values(array_filter([
            ['@type' => 'PropertyValue', 'name' => __('Jenis'), 'value' => $product->type_label],
            ['@type' => 'PropertyValue', 'name' => __('Jenjang'), 'value' => $product->levels_label],
            ['@type' => 'PropertyValue', 'name' => 'Kurikulum', 'value' => 'Kurikulum Merdeka'],
            $product->total_deals > 0 ? ['@type' => 'PropertyValue', 'name' => 'Sekolah pengguna', 'value' => $product->total_deals.'+'] : null,
            $product->on_shopee ? ['@type' => 'PropertyValue', 'name' => __('Tersedia di'), 'value' => 'Shopee Erlass'] : null,
        ])),
        'isRelatedTo' => $related->map(fn ($r) => ['@type' => 'Product', 'name' => $r->name, 'url' => route('products.show', $r->slug)])->all() ?: null,
    ]);
@endphp

@section('title', $product->seo_title.' | '.__('Katalog Erlass Academy'))
@section('description', $product->seo_description)
@section('keywords', implode(', ', array_filter([strtolower($product->name), $category?->name, 'erlass academy', $product->levels_label, 'kurikulum merdeka'])))
@section('og_type', 'product')
@section('og_image', $product->has_photo ? $product->cover_url : asset('img/og-preview.jpg'))
@section('canonical', $url)

@push('head')
    <meta property="product:brand" content="Erlass Academy">
    <meta property="product:category" content="{{ __($category?->name) }}">
    <meta property="product:retailer_item_id" content="{{ $product->sku }}">
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => array_values(array_filter([
            $schemaProduct,
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => array_values(array_filter([
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Katalog Produk', 'item' => route('products.index')],
                    $category ? ['@type' => 'ListItem', 'position' => 3, 'name' => $category->name, 'item' => route('products.index', ['kategori' => $category->slug])] : null,
                    ['@type' => 'ListItem', 'position' => $category ? 4 : 3, 'name' => $product->name, 'item' => $url],
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
<section class="relative bg-slate-50 pt-8 sm:pt-12 pb-16 overflow-hidden">
    @include('partials.side-decor')
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav aria-label="Breadcrumb" class="text-xs sm:text-sm mb-6">
            <ol class="flex flex-wrap items-center gap-2 text-slate-500">
                <li><a href="{{ route('home') }}" class="hover:text-[#219ebc]">{{ __('Beranda') }}</a></li>
                <li aria-hidden="true">/</li>
                <li><a href="{{ route('products.index') }}" class="hover:text-[#219ebc]">{{ __('Katalog') }}</a></li>
                @if($category)
                <li aria-hidden="true">/</li>
                <li><a href="{{ route('products.index', ['kategori' => $category->slug]) }}" class="hover:text-[#219ebc]">{{ __($category->name) }}</a></li>
                @endif
                <li aria-hidden="true">/</li>
                <li class="text-[#023047] font-semibold" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,420px)_1fr] gap-8 lg:gap-14 items-start">
            {{-- Cover --}}
            <div class="lg:sticky lg:top-28">
                <div class="bg-white rounded-[2rem] p-5 border border-slate-200/70 shadow-[0_18px_40px_-20px_rgba(2,48,71,0.35)]">
                    <img src="{{ $product->cover_url }}" alt="{{ __('Sampul') }} {{ $product->name }}" width="600" height="800" fetchpriority="high" class="w-full aspect-[3/4] object-cover rounded-2xl bg-slate-100 ring-1 ring-slate-200/80">
                </div>
            </div>

            {{-- Info --}}
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    @if($badge = $product->badge)
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $badge[1] }}">{{ $badge[0] }}</span>
                    @endif
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#8ecae6]/25 text-[#023047]">{{ $product->type_label }}</span>
                    @if($product->on_shopee)
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-[#ee4d2d]/10 text-[#ee4d2d]">@include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-3.5 h-3.5']) {{ __('Tersedia di Shopee') }}</span>
                    @endif
                    @unless($hasRombel)
                    <span class="px-2.5 py-1 rounded-md bg-white border border-slate-200 text-slate-500 font-mono text-xs font-semibold">Kode: {{ $product->sku }}</span>
                    @endunless
                </div>
                <p class="text-xs sm:text-sm font-semibold uppercase tracking-[0.16em] text-slate-400">{{ __($product->author_label) }}</p>
                <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight leading-tight">{{ $product->name }}</h1>

                <p class="mt-3 inline-flex items-center gap-1.5 text-sm text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12S6 5 12 5s9.5 7 9.5 7-3.5 7-9.5 7S2.5 12 2.5 12z"/><circle cx="12" cy="12" r="3"/></svg>
                    {{ __('Dilihat :count kali', ['count' => number_format($product->views, 0, ',', '.')]) }}
                </p>

                {{-- Answer-first summary --}}
                <p class="mt-5 text-base sm:text-lg text-slate-600 leading-relaxed">{{ $answer }}</p>

                {{-- Key facts --}}
                <dl class="mt-8 grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach([
                        __('Kategori') => $category?->name ? __($category->name) : '-',
                        __('Jenjang') => $product->levels_label,
                        __('Jenis') => $product->type_label,
                        __('Sekolah Pengguna') => $product->total_deals > 0 ? number_format($product->total_deals, 0, ',', '.').'+' : ($product->is_free ? __('Gratis') : __('Baru')),
                    ] as $k => $v)
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-4">
                        <dt class="text-[11px] font-bold uppercase tracking-wider text-slate-400">{{ $k }}</dt>
                        <dd class="mt-1 text-sm font-bold text-[#023047]">{{ $v }}</dd>
                    </div>
                    @endforeach
                </dl>

                {{-- CTAs --}}
                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#25D366] hover:bg-[#20ba59] text-white font-bold shadow-md transition-colors">
                        @include('partials.brand-icon', ['name' => 'whatsapp', 'class' => 'w-5 h-5'])
                        {{ __('Minta Penawaran Sekolah') }}
                    </a>
                    @if($product->lms_url)
                    <a href="{{ $product->lms_url }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#219ebc] hover:bg-[#023047] text-white font-bold shadow-md transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $product->is_free ? __('Akses Gratis di LMS') : __('Buka di LMS Erlass Academy') }}
                    </a>
                    @endif
                    @if($product->shop_link)
                    <a href="{{ $product->shop_link }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#ee4d2d] hover:bg-[#d73211] text-white font-bold shadow-md transition-colors">
                        @include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-5 h-5'])
                        {{ __('Beli di Shopee') }}
                    </a>
                    @endif
                </div>

                @if($product->description)
                <div class="mt-10">
                    <h2 class="text-xl font-extrabold text-[#023047] mb-3">{{ __('Deskripsi Produk') }}</h2>
                    <p class="text-slate-600 leading-relaxed">{{ $product->description }}</p>
                </div>
                @endif

                @if($features)
                <div class="mt-8">
                    <h2 class="text-xl font-extrabold text-[#023047] mb-3">{{ __('Yang Didapat Sekolah') }}</h2>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($features as $f)
                        <li class="flex items-start gap-3 bg-white rounded-xl border border-slate-200/80 p-4 text-sm text-slate-700">
                            <svg class="w-5 h-5 shrink-0 text-[#219ebc]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            {{ __($f) }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($faqs)
                <div class="mt-10">
                    <h2 class="text-xl font-extrabold text-[#023047] mb-4">{{ __('Pertanyaan Umum') }}</h2>
                    <div class="space-y-3">
                        @foreach($faqs as [$q, $a])
                        <details class="group bg-white rounded-2xl border border-slate-200 p-5" @if($loop->first) open @endif>
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
        </div>

        @if($related->isNotEmpty())
        <div class="mt-20">
            <div class="flex items-end justify-between gap-4 mb-6">
                <h2 class="text-2xl font-extrabold text-[#023047]">{{ __('Produk Terkait') }}</h2>
                @if($category)
                <a href="{{ route('products.index', ['kategori' => $category->slug]) }}" class="text-sm font-bold text-[#219ebc] hover:text-[#023047]">{{ __('Lihat :name →', ['name' => __($category->name)]) }}</a>
                @endif
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($related as $r)
                    @include('products._card', ['product' => $r])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
