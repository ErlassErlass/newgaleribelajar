@extends('layouts.app')
@section('title', 'Terjadi Kesalahan - Erlass Institute')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center bg-[#F8FAFC] relative overflow-hidden py-24">
    <!-- Background Decor -->
    <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
        <svg class="absolute top-10 right-10 w-24 h-24 text-red-500 -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
    </div>

    <div class="relative z-10 text-center px-4 max-w-2xl mx-auto">
        <div class="mb-8 relative inline-block">
            <span class="font-serif font-black text-9xl text-kids-navy tracking-tighter drop-shadow-md">500</span>
            <div class="absolute -top-4 -right-8 bg-red-500 text-white font-bold px-4 py-2 rounded-full rotate-12 shadow-sm text-sm">
                Error!
            </div>
        </div>
        
        <h1 class="font-serif text-3xl md:text-4xl font-bold text-[#111111] mb-4 leading-tight">
            Ups! Sistem Sedang Gangguan
        </h1>
        
        <p class="text-lg text-[#111111]/70 font-sans mb-10 max-w-lg mx-auto">
            Maaf, terjadi kesalahan pada server kami saat mencoba memproses permintaan Anda. Tim teknis kami sudah diberitahu dan sedang memperbaikinya.
        </p>

        <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-4 bg-kids-navy text-white font-bold rounded-full transition-all duration-300 hover:scale-105 shadow-[0_6px_0_rgba(153,225,255,1)] hover:shadow-[0_8px_0_rgba(153,225,255,1)] text-lg">
            Kembali ke Beranda
        </a>
    </div>
</section>
@endsection
