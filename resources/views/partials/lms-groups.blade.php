{{-- LMS columns (Intrakurikuler / Course / Asesmen …) with their products. Used by /lms. Needs $lmsGroups. --}}
@php
    // 1 column: full width · 2: two · 4: four on wide screens · otherwise three per row
    $lmsGrid = match ($lmsGroups->count()) {
        1 => '',
        2 => 'lg:grid-cols-2',
        4 => 'lg:grid-cols-2 xl:grid-cols-4',
        default => 'lg:grid-cols-3',
    };
@endphp
<div class="grid grid-cols-1 {{ $lmsGrid }} gap-6">
    @foreach($lmsGroups as $group)
        @php $items = $group->products; @endphp
        <div id="lms-{{ $group->slug }}" class="bg-slate-50 rounded-3xl border border-slate-200/80 p-6 flex flex-col scroll-mt-40 target:ring-2 target:ring-[#219ebc] target:ring-offset-2">
            <div class="flex items-center gap-3 mb-2">
                <span class="w-2.5 h-8 rounded-full" style="background: {{ $group->color }}"></span>
                <h3 class="text-lg font-extrabold text-[#023047]">{{ __($group->title) }}</h3>
            </div>
            @if($group->description)<p class="text-sm text-slate-600 leading-relaxed mb-5">{{ __($group->description) }}</p>@else<div class="mb-3"></div>@endif
            <ul class="space-y-3 flex-1">
                @foreach($items as $item)
                <li>
                    <a href="{{ route('products.show', $item->slug) }}" class="group flex items-center gap-4 p-2.5 pr-4 rounded-2xl bg-white border border-slate-200/80 hover:border-[#219ebc] hover:shadow-md transition-all">
                        <img src="{{ $item->cover_url }}" alt="" width="48" height="64" loading="lazy" class="w-12 h-16 rounded-lg object-cover ring-1 ring-slate-200 shrink-0">
                        <span class="flex-1 min-w-0">
                            <span class="block text-sm font-bold text-[#023047] group-hover:text-[#219ebc] leading-snug">{{ $item->name }}</span>
                            <span class="block text-xs text-slate-500 mt-0.5">{{ $item->levels_label }}</span>
                        </span>
                        @if($item->on_shopee)
                        <span class="shrink-0 inline-flex items-center gap-1 px-2 py-1 rounded-full bg-[#ee4d2d]/10 text-[#ee4d2d] text-[10px] font-bold" title="{{ __('Tersedia di Shopee Erlass') }}">
                            @include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-3 h-3']) Shopee
                        </span>
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
