{{-- Decorative ornaments for page margins. Parent must be `relative overflow-x-clip` (or overflow-hidden).
     Hidden below lg so small screens stay clean. --}}
<div class="pointer-events-none absolute inset-0 hidden lg:block" aria-hidden="true">
    {{-- Soft brand blobs --}}
    <div class="absolute -left-40 top-24 w-96 h-96 rounded-full bg-[#8ecae6]/25 blur-3xl"></div>
    <div class="absolute -right-40 top-[40%] w-[28rem] h-[28rem] rounded-full bg-[#ffb703]/15 blur-3xl"></div>
    <div class="absolute -left-32 bottom-10 w-80 h-80 rounded-full bg-[#219ebc]/10 blur-3xl"></div>

    {{-- Dot grids --}}
    <svg class="absolute left-8 top-40 w-40 h-56 text-[#219ebc]/25" fill="currentColor">
        <defs><pattern id="decor-dots-l" width="16" height="16" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="2"/></pattern></defs>
        <rect width="100%" height="100%" fill="url(#decor-dots-l)"/>
    </svg>
    <svg class="absolute right-8 bottom-40 w-40 h-56 text-[#fb8500]/25" fill="currentColor">
        <defs><pattern id="decor-dots-r" width="16" height="16" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="2"/></pattern></defs>
        <rect width="100%" height="100%" fill="url(#decor-dots-r)"/>
    </svg>

    {{-- Tech line shapes: code brackets, circuit ring, diamond (echoes the logo) --}}
    <svg class="absolute left-[6%] top-[55%] w-16 h-16 text-[#023047]/15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
    <svg class="absolute right-[7%] top-48 w-20 h-20 text-[#219ebc]/20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="M12 3v5M12 16v5M3 12h5M16 12h5"/></svg>
    <svg class="absolute right-[12%] top-[72%] w-12 h-12 text-[#fb8500]/30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2l10 10-10 10L2 12z"/></svg>
    <svg class="absolute left-[12%] top-24 w-10 h-10 text-[#ffb703]/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2l10 10-10 10L2 12z"/></svg>
</div>
