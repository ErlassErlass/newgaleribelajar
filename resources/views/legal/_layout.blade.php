@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-br from-[#dff2fa] via-white to-[#fff2d4] text-[#023047] border-b border-[#8ecae6]/40 pt-16 pb-14">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-3">
        <p class="text-xs font-bold uppercase tracking-wider text-[#219ebc]">Legal</p>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">@yield('legal_title')</h1>
        <p class="text-sm text-slate-600">Terakhir diperbarui: @yield('legal_updated')</p>
    </div>
</section>
<section class="py-14 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-slate-700 leading-relaxed space-y-8
                [&_h2]:text-xl [&_h2]:font-bold [&_h2]:text-[#023047] [&_h2]:mb-3
                [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:space-y-1.5 [&_p]:mb-3">
        @yield('legal_body')
        <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 text-sm">
            {{ __('Pertanyaan terkait dokumen ini dapat dikirim ke') }}
            <a href="mailto:{{ config('erlass.email') }}" class="font-semibold text-[#219ebc] hover:underline">{{ config('erlass.email') }}</a>
            {{ __('atau WhatsApp') }} <a href="https://wa.me/{{ config('erlass.whatsapp') }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#219ebc] hover:underline">{{ config('erlass.phone_display') }}</a>.
        </div>
    </div>
</section>
@endsection
