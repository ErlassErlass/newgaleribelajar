{{-- One school in the homepage marquee. $school (Partner), $warm (bool: second row colors), $hidden (bool: duplicate for the seamless loop) --}}
@php $logo = $school->logoUrl(); @endphp
<div class="inline-flex items-center gap-3 px-5 py-3 rounded-xl bg-slate-50 border border-[#8ecae6]/40 shadow-xs transition-all shrink-0 {{ $warm ? 'hover:border-[#fb8500] hover:bg-amber-50/50' : 'hover:border-[#219ebc] hover:bg-sky-50/50' }}" @if($hidden) aria-hidden="true" @endif>
    @if($logo)
    <img src="{{ $logo }}" alt="{{ $hidden ? '' : __('Logo :name', ['name' => $school->name]) }}" width="40" height="40" loading="lazy" decoding="async"
         class="w-10 h-10 rounded-lg object-contain bg-white ring-1 ring-slate-200 p-0.5 shrink-0">
    @else
    <div class="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 {{ $warm ? 'bg-[#ffb703]/20 text-[#023047]' : 'bg-[#219ebc]/10 text-[#0369a1]' }}">
        {{ $school->level ?: 'SCH' }}
    </div>
    @endif
    <div class="text-left">
        <p class="text-xs font-bold text-[#023047] leading-tight">{{ $school->name }}</p>
        <p class="text-[10px] text-slate-500">{{ $school->city ?: 'Indonesia' }} · {{ __(':count Program', ['count' => $school->total_deals]) }}</p>
    </div>
</div>
