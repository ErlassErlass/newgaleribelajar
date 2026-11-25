@extends('layouts.app')

@php
    $articleUrl = route('articles.show', $article->slug);
    $ogImage = $article->cover_image ? asset($article->cover_image) : asset('img/og-preview.jpg');
    $hashtags = $article->share_tags;                       // without '#'
    $hashtagLine = collect($hashtags)->map(fn ($t) => '#'.$t)->implode(' ');
    $shareUrl = urlencode($articleUrl);
    $shareText = urlencode($article->title);
    $shareLinks = [
        ['name' => 'facebook', 'label' => __('Bagikan ke Facebook'), 'href' => "https://www.facebook.com/sharer/sharer.php?u={$shareUrl}&hashtag=".urlencode('#'.$hashtags[0])],
        ['name' => 'x',        'label' => __('Bagikan ke X'),        'href' => "https://twitter.com/intent/tweet?url={$shareUrl}&text={$shareText}&hashtags=".urlencode(implode(',', array_slice($hashtags, 0, 4)))],
        ['name' => 'whatsapp', 'label' => __('Bagikan ke WhatsApp'), 'href' => 'https://wa.me/?text='.urlencode($article->title."\n".$articleUrl."\n\n".$hashtagLine)],
    ];
    // Caption ready to paste into Instagram / TikTok / Facebook
    $caption = $article->title."\n\n".$article->excerpt."\n\nBaca selengkapnya: ".$articleUrl."\n\n".$hashtagLine;
@endphp

@section('title', $article->seo_title.' | Erlass Academy')
@section('description', $article->seo_description)
@section('keywords', implode(', ', array_merge([$article->category_label, 'Erlass Academy'], array_map(fn ($t) => strtolower(preg_replace('/(?<!^)[A-Z]/', ' $0', $t)), $article->tags ?? []))))
@section('og_type', 'article')
@section('og_image', $ogImage)
@section('canonical', $articleUrl)

@push('head')
    @if($article->published_at)
    <meta property="article:published_time" content="{{ $article->published_at->toAtomString() }}">
    @endif
    <meta property="article:modified_time" content="{{ $article->updated_at->toAtomString() }}">
    <meta property="article:section" content="{{ __($article->category_label) }}">
    @foreach($hashtags as $t)
    <meta property="article:tag" content="{{ $t }}">
    @endforeach
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => in_array($article->category, ['artikel', 'kegiatan']) ? 'BlogPosting' : 'NewsArticle',
        'headline' => $article->title,
        'description' => $article->seo_description,
        'image' => [$ogImage],
        'datePublished' => optional($article->published_at)->toAtomString(),
        'dateModified' => $article->updated_at->toAtomString(),
        'mainEntityOfPage' => $articleUrl,
        'articleSection' => $article->category_label,
        'keywords' => implode(', ', $hashtags),
        'wordCount' => str_word_count((string) $article->body),
        'inLanguage' => 'id-ID',
        'commentCount' => $commentCount,
        'author' => ['@type' => 'Organization', 'name' => 'Erlass Academy', 'url' => route('home')],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'PT Erlass Prokreatif Indonesia',
            'logo' => ['@type' => 'ImageObject', 'url' => asset('img/logo.png')],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Artikel', 'item' => route('articles.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $article->category_label, 'item' => route('articles.index', ['kategori' => $article->category])],
            ['@type' => 'ListItem', 'position' => 4, 'name' => $article->title, 'item' => $articleUrl],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
{{-- Mobile/tablet reading progress: thin bar pinned to the top of the viewport --}}
<div class="xl:hidden fixed top-0 inset-x-0 h-1 z-[60] bg-transparent" aria-hidden="true">
    <div class="js-read-bar h-full w-0 bg-gradient-to-r from-[#219ebc] to-[#fb8500] transition-[width] duration-100"></div>
</div>

<article itemscope itemtype="https://schema.org/Article">
    <header class="relative bg-gradient-to-br from-[#dff2fa] via-white to-[#fff2d4] text-[#023047] border-b border-[#8ecae6]/40 pt-10 sm:pt-14 pb-24 overflow-hidden">
        <div class="absolute inset-0 hero-grid-pattern opacity-40 pointer-events-none"></div>
        <div class="absolute -right-24 -top-24 w-80 h-80 rounded-full bg-[#8ecae6]/30 blur-3xl pointer-events-none"></div>
        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            {{-- Breadcrumb --}}
            <nav aria-label="Breadcrumb" class="text-xs sm:text-sm">
                <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-slate-500">
                    <li><a href="{{ route('home') }}" class="hover:text-[#219ebc]">{{ __('Beranda') }}</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-[#219ebc]">{{ __('Artikel') }}</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('articles.index', ['kategori' => $article->category]) }}" class="text-[#219ebc] hover:text-[#219ebc]">{{ __($article->category_label) }}</a></li>
                </ol>
            </nav>
            <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-xs font-semibold">
                <a href="{{ route('articles.index', ['kategori' => $article->category]) }}" class="px-2.5 py-1 rounded-md bg-[#ffb703] text-[#023047] uppercase tracking-wider">{{ __($article->category_label) }}</a>
                @if($article->published_at)
                <time itemprop="datePublished" datetime="{{ $article->published_at->toAtomString() }}" class="text-slate-600">{{ $article->published_at->translatedFormat('d F Y') }}</time>
                @endif
                <span class="text-slate-400" aria-hidden="true">·</span>
                <span class="text-slate-600">{{ __(':count menit baca', ['count' => $article->read_minutes]) }}</span>
                <span class="text-slate-400" aria-hidden="true">·</span>
                <span class="text-slate-600">{{ __(':count kali dilihat', ['count' => number_format($article->views, 0, ',', '.')]) }}</span>
                <span class="text-slate-400" aria-hidden="true">·</span>
                <a href="#comments" class="text-slate-600 hover:text-[#219ebc]">{{ __(':count komentar', ['count' => $commentCount]) }}</a>
            </div>
            <h1 itemprop="headline" class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight">{{ $article->title }}</h1>
            @if($article->excerpt)
            <p itemprop="description" class="text-slate-600 text-base sm:text-lg leading-relaxed">{{ $article->excerpt }}</p>
            @endif
        </div>
    </header>

    {{-- overflow-x-clip (not hidden) so the cover can overlap the header and sticky rails keep working --}}
    <div class="relative overflow-x-clip">
        @include('partials.side-decor')

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 xl:grid xl:grid-cols-[96px_minmax(0,48rem)_96px] xl:justify-center xl:gap-10">

            {{-- Left rail: vertical reading progress (desktop) --}}
            <aside class="hidden xl:block" aria-hidden="true">
                <div class="sticky top-40 flex flex-col items-center gap-3 pt-32">
                    <span class="text-[10px] font-bold tracking-[0.3em] text-slate-400 [writing-mode:vertical-rl] rotate-180">PROGRES</span>
                    <div class="relative w-1 h-64 rounded-full bg-slate-200 overflow-hidden">
                        <div class="js-read-bar-v absolute top-0 inset-x-0 h-0 rounded-full bg-gradient-to-b from-[#219ebc] to-[#023047]"></div>
                    </div>
                    <span class="js-read-pct text-sm font-bold text-slate-400 tabular-nums">0%</span>
                </div>
            </aside>

            {{-- Article body --}}
            <div class="-mt-14 min-w-0">
                @if($article->cover_image)
                <img itemprop="image" src="{{ $ogImage }}" alt="{{ $article->title }}" width="1024" height="576" class="w-full aspect-[16/9] object-cover rounded-2xl shadow-xl border border-slate-200 bg-slate-100">
                @endif

                <div id="article-body" itemprop="articleBody" class="py-10 sm:py-12 space-y-5 text-slate-700 text-base sm:text-lg leading-relaxed [&>p:first-child]:first-letter:text-5xl [&>p:first-child]:first-letter:font-extrabold [&>p:first-child]:first-letter:text-[#219ebc] [&>p:first-child]:first-letter:float-left [&>p:first-child]:first-letter:mr-2 [&>p:first-child]:first-letter:leading-none">
                    @foreach($article->paragraphs as $paragraph)
                    <p>{{ $paragraph }}</p>
                    @endforeach
                </div>

                {{-- Hashtags --}}
                @if(!empty($article->tags))
                <div class="flex flex-wrap items-center gap-2 pb-6">
                    <span class="text-xs font-bold tracking-widest text-slate-400 uppercase mr-1">Hashtag</span>
                    @foreach($article->tags as $tag)
                    <a href="{{ route('articles.index', ['tag' => $tag]) }}" rel="tag" class="px-3 py-1.5 rounded-full bg-[#8ecae6]/20 text-[#023047] hover:bg-[#219ebc] hover:text-white text-sm font-semibold transition-colors">#{{ $tag }}</a>
                    @endforeach
                </div>
                @endif

                {{-- Share row (all sizes): native share + copy caption are the way into Instagram/TikTok --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 mb-8">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-xs font-bold tracking-widest text-slate-400 uppercase mr-1">{{ __('Bagikan') }}</span>
                        @foreach($shareLinks as $s)
                        <a href="{{ $s['href'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ __($s['label']) }}" title="{{ __($s['label']) }}" class="xl:hidden w-11 h-11 rounded-full border border-slate-200 bg-white text-slate-500 hover:text-white hover:bg-[#219ebc] hover:border-[#219ebc] flex items-center justify-center transition-colors">
                            @include('partials.brand-icon', ['name' => $s['name'], 'class' => 'w-5 h-5'])
                        </a>
                        @endforeach
                        <button type="button" class="js-native-share hidden h-11 px-4 rounded-full bg-[#023047] text-white text-sm font-bold items-center gap-2 hover:bg-[#219ebc] transition-colors"
                                data-title="{{ $article->title }}" data-text="{{ $article->excerpt }} {{ $hashtagLine }}" data-url="{{ $articleUrl }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                            {{ __('Bagikan ke Aplikasi') }}
                        </button>
                        <button type="button" class="js-copy-link h-11 px-4 rounded-full border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:border-[#219ebc] hover:text-[#219ebc] inline-flex items-center gap-2 transition-colors" aria-label="{{ __('Salin tautan') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            {{ __('Salin Link') }}
                        </button>
                        <button type="button" class="js-copy-caption h-11 px-4 rounded-full border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:border-[#fb8500] hover:text-[#fb8500] inline-flex items-center gap-2 transition-colors" data-caption="{{ $caption }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                            {{ __('Salin Caption + Hashtag') }}
                        </button>
                    </div>
                    <p class="text-xs text-slate-500 mt-3">{{ __('Tips: gunakan') }} <strong>{{ __('Salin Caption + Hashtag') }}</strong> {{ __('lalu tempel saat memposting ke Instagram, TikTok, atau Facebook.') }}</p>
                </div>

                {{-- Previous / Next --}}
                @if($previous || $next)
                <nav class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10" aria-label="{{ __('Navigasi artikel') }}">
                    @if($previous)
                    <a href="{{ route('articles.show', $previous->slug) }}" rel="prev" class="group flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-white hover:border-[#219ebc] hover:shadow-md transition-all">
                        <span class="shrink-0 w-10 h-10 rounded-full bg-slate-100 group-hover:bg-[#219ebc] group-hover:text-white text-slate-500 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                        </span>
                        <span class="min-w-0">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">{{ __('Sebelumnya') }}</span>
                            <span class="block text-sm font-bold text-[#023047] group-hover:text-[#219ebc] line-clamp-2">{{ $previous->title }}</span>
                        </span>
                    </a>
                    @else
                    <span class="hidden sm:block"></span>
                    @endif
                    @if($next)
                    <a href="{{ route('articles.show', $next->slug) }}" rel="next" class="group flex items-center justify-end gap-4 p-4 rounded-2xl border border-slate-200 bg-white hover:border-[#219ebc] hover:shadow-md transition-all text-right">
                        <span class="min-w-0">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">{{ __('Selanjutnya') }}</span>
                            <span class="block text-sm font-bold text-[#023047] group-hover:text-[#219ebc] line-clamp-2">{{ $next->title }}</span>
                        </span>
                        <span class="shrink-0 w-10 h-10 rounded-full bg-slate-100 group-hover:bg-[#219ebc] group-hover:text-white text-slate-500 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                    @endif
                </nav>
                @endif

                <div class="mb-12 p-6 sm:p-8 rounded-2xl bg-gradient-to-r from-[#023047] to-[#219ebc] text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <p class="font-bold text-lg">{{ __('Tertarik menghadirkan program ini di sekolah Anda?') }}</p>
                        <p class="text-sm text-slate-100">{{ __('Tim konsultan Erlass siap membantu merancang program yang sesuai.') }}</p>
                    </div>
                    <a href="{{ route('home') }}#contact" class="shrink-0 px-5 py-3 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow-md transition-colors">{{ __('Konsultasi Sekarang') }}</a>
                </div>

                @include('articles._comments')
            </div>

            {{-- Right rail: share column (desktop) --}}
            <aside class="hidden xl:block">
                <div class="sticky top-40 flex flex-col items-center gap-4 pt-32">
                    <span class="text-xs font-bold tracking-[0.3em] text-slate-300 [writing-mode:vertical-rl]">SHARE</span>
                    @foreach($shareLinks as $s)
                    <a href="{{ $s['href'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ __($s['label']) }}" title="{{ __($s['label']) }}" class="w-12 h-12 rounded-full border border-slate-200 bg-white text-slate-500 hover:text-white hover:bg-[#219ebc] hover:border-[#219ebc] hover:-translate-y-0.5 shadow-sm flex items-center justify-center transition-all">
                        @include('partials.brand-icon', ['name' => $s['name'], 'class' => 'w-5 h-5'])
                    </a>
                    @endforeach
                    <button type="button" class="js-copy-link w-12 h-12 rounded-full border border-slate-200 bg-white text-slate-500 hover:text-white hover:bg-[#219ebc] hover:border-[#219ebc] hover:-translate-y-0.5 shadow-sm flex items-center justify-center transition-all" aria-label="{{ __('Salin tautan') }}" title="{{ __('Salin tautan') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </button>
                    <a href="#comments" class="w-12 h-12 rounded-full border border-slate-200 bg-white text-slate-500 hover:text-white hover:bg-[#fb8500] hover:border-[#fb8500] hover:-translate-y-0.5 shadow-sm flex flex-col items-center justify-center transition-all" aria-label="{{ __('Lihat komentar') }}" title="{{ __('Komentar') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </a>
                    <span class="text-xs font-bold text-slate-400 -mt-2">{{ $commentCount }}</span>
                </div>
            </aside>
        </div>
    </div>
</article>

{{-- Toast for copy actions --}}
<div id="copy-toast" class="fixed bottom-24 left-1/2 -translate-x-1/2 z-[70] px-4 py-2 rounded-xl bg-[#023047] text-white text-sm font-semibold shadow-lg opacity-0 pointer-events-none transition-opacity" role="status" aria-live="polite">{{ __('Tautan disalin') }}</div>

@if($related->isNotEmpty())
<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4 mb-6">
            <h2 class="text-2xl font-bold text-[#023047]">{{ __('Artikel Terkait') }}</h2>
            <a href="{{ route('articles.index') }}" class="text-sm font-bold text-[#219ebc] hover:text-[#023047] shrink-0">{{ __('Semua Artikel →') }}</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($related as $item)
                @include('articles._card', ['article' => $item])
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
    (function () {
        const body = document.getElementById('article-body');
        const bars = document.querySelectorAll('.js-read-bar');
        const barV = document.querySelector('.js-read-bar-v');
        const pct = document.querySelector('.js-read-pct');

        function update() {
            if (!body) return;
            const rect = body.getBoundingClientRect();
            const total = body.offsetHeight - window.innerHeight * 0.5;
            const read = Math.min(Math.max(-rect.top + window.innerHeight * 0.5, 0), Math.max(total, 1));
            const p = Math.round((read / Math.max(total, 1)) * 100);
            bars.forEach(function (b) { b.style.width = p + '%'; });
            if (barV) barV.style.height = p + '%';
            if (pct) {
                pct.textContent = p + '%';
                pct.classList.toggle('text-[#219ebc]', p >= 100);
            }
        }
        window.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
        update();

        const toast = document.getElementById('copy-toast');
        function showToast(msg) {
            toast.textContent = msg;
            toast.classList.remove('opacity-0');
            clearTimeout(showToast.t);
            showToast.t = setTimeout(function () { toast.classList.add('opacity-0'); }, 2000);
        }
        function copy(text, msg) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(function () { showToast(msg); })
                    .catch(function () { window.prompt(@json(__('Salin teks berikut:')), text); });
            } else {
                window.prompt(@json(__('Salin teks berikut:')), text);
            }
        }
        document.querySelectorAll('.js-copy-link').forEach(function (btn) {
            btn.addEventListener('click', function () { copy(window.location.href.split('#')[0], @json(__('Tautan disalin'))); });
        });
        document.querySelectorAll('.js-copy-caption').forEach(function (btn) {
            btn.addEventListener('click', function () { copy(btn.dataset.caption, @json(__('Caption + hashtag disalin'))); });
        });

        // Native share sheet (mobile): reaches Instagram, TikTok, Telegram, etc.
        if (navigator.share) {
            document.querySelectorAll('.js-native-share').forEach(function (btn) {
                btn.classList.remove('hidden');
                btn.classList.add('inline-flex');
                btn.addEventListener('click', function () {
                    navigator.share({ title: btn.dataset.title, text: btn.dataset.text, url: btn.dataset.url }).catch(function () {});
                });
            });
        }
    })();
</script>
@endsection
