{{-- Usage: {{ $paginator->links('partials.pagination') }} --}}
@if($paginator->hasPages())
@php
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();
    // Window of page numbers around the current page, with first/last always shown
    $pages = collect([1, $last])->merge(range(max(1, $current - 1), min($last, $current + 1)))->unique()->sort()->values();
    $btn = 'inline-flex items-center justify-center min-w-10 h-10 px-3 rounded-xl text-sm font-bold border transition-colors';
@endphp
<nav class="flex flex-col sm:flex-row items-center justify-between gap-4" role="navigation" aria-label="{{ __('Navigasi halaman') }}">
    <p class="text-sm text-slate-500">
        {{ __('Menampilkan') }} <strong class="text-[#023047]">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</strong>
        {{ __('dari') }} <strong class="text-[#023047]">{{ $paginator->total() }}</strong> · {{ __('Halaman :current dari :last', ['current' => $current, 'last' => $last]) }}
    </p>

    <ul class="flex flex-wrap items-center gap-2">
        <li>
            @if($paginator->onFirstPage())
            <span class="{{ $btn }} border-slate-200 text-slate-300 bg-white cursor-not-allowed" aria-disabled="true">{{ __('‹ Sebelumnya') }}</span>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="{{ $btn }} border-slate-200 text-[#023047] bg-white hover:border-[#219ebc] hover:text-[#219ebc]">{{ __('‹ Sebelumnya') }}</a>
            @endif
        </li>

        @foreach($pages as $i => $page)
            @if($i > 0 && $page - $pages[$i - 1] > 1)
            <li><span class="px-1 text-slate-400" aria-hidden="true">…</span></li>
            @endif
            <li class="hidden sm:block">
                @if($page === $current)
                <span class="{{ $btn }} bg-[#023047] border-[#023047] text-white" aria-current="page">{{ $page }}</span>
                @else
                <a href="{{ $paginator->url($page) }}" class="{{ $btn }} border-slate-200 text-[#023047] bg-white hover:border-[#219ebc] hover:text-[#219ebc]" aria-label="{{ __('Halaman :page', ['page' => $page]) }}">{{ $page }}</a>
                @endif
            </li>
        @endforeach

        <li>
            @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="{{ $btn }} border-[#fb8500] bg-[#fb8500] text-white hover:bg-[#e07600]">{{ __('Berikutnya ›') }}</a>
            @else
            <span class="{{ $btn }} border-slate-200 text-slate-300 bg-white cursor-not-allowed" aria-disabled="true">{{ __('Berikutnya ›') }}</span>
            @endif
        </li>
    </ul>
</nav>
@endif
