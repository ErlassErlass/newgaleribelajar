{{-- One button per LMS column (Intrakurikuler / Course / Asesmen …) with its product count.
     $jumpBase: '' to jump within the /lms page, or route('lms.index') to open it from elsewhere. Needs $lmsGroups. --}}
@if($lmsGroups->isNotEmpty())
<nav class="flex flex-wrap justify-center gap-3" aria-label="{{ __('Kategori LMS') }}">
    @foreach($lmsGroups as $group)
    <a href="{{ ($jumpBase ?? '') }}#lms-{{ $group->slug }}" class="group flex items-center gap-3 pl-3 pr-4 py-2.5 rounded-2xl bg-white/80 backdrop-blur border border-[#8ecae6]/70 hover:border-[#219ebc] hover:-translate-y-0.5 hover:shadow-md transition-all">
        <span class="w-2 h-8 rounded-full" style="background: {{ $group->color ?: '#219ebc' }}" aria-hidden="true"></span>
        <span class="text-left">
            <span class="block text-sm font-extrabold text-[#023047] group-hover:text-[#219ebc]">{{ __($group->title) }}</span>
            <span class="block text-xs text-slate-500"><strong class="text-[#fb8500]">{{ $group->products->count() }}</strong> {{ __('produk') }}</span>
        </span>
    </a>
    @endforeach
</nav>
@endif
