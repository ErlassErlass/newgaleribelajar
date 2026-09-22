@extends('layouts.app')
@section('title', 'Halaman Tidak Ditemukan - Erlass Institute')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center bg-kids-yellow relative overflow-hidden py-24">
    <!-- Background Decor -->
    <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
        <svg class="absolute top-10 left-10 w-24 h-24 text-kids-pink rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
        <svg class="absolute bottom-20 right-10 w-32 h-32 text-kids-navy -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
    </div>

    <div class="relative z-10 text-center px-4 max-w-2xl mx-auto">
        <div class="mb-8 relative inline-block">
            <span class="font-serif font-black text-9xl text-kids-navy tracking-tighter drop-shadow-md">404</span>
            <div class="absolute -top-4 -right-8 bg-kids-pink text-white font-bold px-4 py-2 rounded-full rotate-12 shadow-sm text-sm">
                Oops!
            </div>
        </div>
        
        <h1 class="font-serif text-3xl md:text-4xl font-bold text-[#111111] mb-4 leading-tight">
            Sepertinya Kita Tersesat!
        </h1>
        
        <p class="text-lg text-[#111111]/70 font-sans mb-10 max-w-lg mx-auto">
            Halaman yang Anda cari mungkin sudah dipindahkan, dihapus, atau Anda salah mengetikkan alamatnya. Mari kembali ke jalur yang benar.
        </p>

        <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-4 bg-kids-navy text-white font-bold rounded-full transition-all duration-300 hover:scale-105 shadow-[0_6px_0_rgba(153,225,255,1)] hover:shadow-[0_8px_0_rgba(153,225,255,1)] text-lg">
            Kembali ke Beranda
        </a>
    </div>
</section>
@endsection
