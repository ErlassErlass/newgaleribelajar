{{-- "Gratis untuk Guru" banner (Pusat Sumber Daya Guru). Shared by the homepage and /lms. Needs $resourceHub. --}}
@if($resourceHub)
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#219ebc] via-[#0b8fc6] to-[#0369a1] text-white p-6 sm:p-10 mb-8 grid grid-cols-1 md:grid-cols-[1fr_auto] gap-6 items-center">
    <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-white/10 pointer-events-none"></div>
    <div class="relative">
        <span class="inline-block px-3 py-1 rounded-full bg-emerald-400 text-[#023047] text-xs font-extrabold uppercase tracking-wider">{{ __('Gratis untuk Guru') }}</span>
        <h3 class="text-2xl sm:text-3xl font-extrabold mt-3">{{ __($resourceHub->name) }}</h3>
        <p class="text-slate-100 mt-2 max-w-2xl leading-relaxed">{{ __($resourceHub->summary) }}</p>
    </div>
    <div class="relative flex flex-col sm:flex-row md:flex-col gap-3">
        <a href="{{ $resourceHub->lms_url }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white text-[#023047] font-bold shadow-md hover:-translate-y-0.5 transition-transform">
            {{ __('Akses Gratis Sekarang →') }}
        </a>
        <a href="{{ route('products.show', $resourceHub->slug) }}" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/30 font-bold text-sm transition-colors">
            {{ __('Lihat Detail') }}
        </a>
    </div>
</div>
@endif
