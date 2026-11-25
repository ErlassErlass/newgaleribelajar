{{-- Book-style product card. Vars: $product, $eager (bool, optional) --}}
@php $url = route('products.show', $product->slug); @endphp
<article class="product-book-card group h-full bg-white rounded-[1.75rem] p-4 sm:p-5 border border-slate-200/70 shadow-[0_8px_30px_-12px_rgba(2,48,71,0.12)] hover:border-[#1d4ed8] hover:shadow-[0_18px_40px_-16px_rgba(29,78,216,0.35)] transition-all duration-300 flex flex-col">
    <a href="{{ $url }}" class="relative block aspect-[3/4] rounded-2xl overflow-hidden bg-slate-100 ring-1 ring-slate-200/80" aria-label="{{ $product->name }}">
        <img src="{{ $product->cover_url }}"
             alt="{{ __('Sampul') }} {{ $product->name }} – {{ $product->category?->name ? __($product->category->name) : 'Erlass Academy' }}"
             width="600" height="800"
             class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-500"
             @unless($eager ?? false) loading="lazy" decoding="async" @endunless>
        {{-- Generated covers already carry brand + level; only label real photos --}}
        @if($product->has_photo)
        <span class="absolute top-3 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full bg-white/95 text-[#1d4ed8] text-[11px] font-bold tracking-wider uppercase shadow-sm">Erlass</span>
        <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-black/60 to-transparent pointer-events-none"></div>
        <span class="absolute left-4 bottom-3 text-white text-sm font-semibold drop-shadow">{{ $product->levels_label }}</span>
        @endif
    </a>

    <div class="pt-5 px-1 flex flex-col flex-1">
        <div class="flex items-center gap-2 mb-3 min-h-[28px]">
            @if($badge = $product->badge)
            <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider {{ $badge[1] }}">{{ $badge[0] }}</span>
            @endif
            @if($product->on_shopee)
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#ee4d2d]/10 text-[#ee4d2d] text-[11px] font-bold" title="{{ __('Tersedia di Shopee Erlass') }}">
                @include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-3.5 h-3.5']) Shopee
            </span>
            @endif
        </div>
        <p class="text-[11px] sm:text-xs font-semibold uppercase tracking-[0.14em] text-slate-400 mb-1.5 line-clamp-1">{{ __($product->author_label) }}</p>
        <h3 class="text-base sm:text-lg font-semibold text-[#023047] leading-snug line-clamp-2">
            <a href="{{ $url }}" class="hover:text-[#1d4ed8]">{{ $product->name }}</a>
        </h3>
        @if($product->total_deals > 0)
        <p class="text-xs text-slate-500 mt-2">{{ __('Dipakai') }} <strong class="text-[#fb8500]">{{ number_format($product->total_deals, 0, ',', '.') }}+</strong> {{ __('sekolah mitra') }}</p>
        @elseif($product->on_lms)
        <p class="text-xs text-slate-500 mt-2">{{ __('Diakses lewat') }} <strong class="text-[#219ebc]">{{ __('LMS Erlass Academy') }}</strong></p>
        @endif
        <p class="text-[11px] text-slate-400 mt-1 inline-flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12S6 5 12 5s9.5 7 9.5 7-3.5 7-9.5 7S2.5 12 2.5 12z"/><circle cx="12" cy="12" r="3"/></svg>
            {{ number_format($product->views, 0, ',', '.') }}× {{ __('dilihat') }}
        </p>
    </div>
</article>
