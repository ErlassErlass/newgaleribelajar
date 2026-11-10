@extends('layouts.app')
@section('title', 'Terjadi Gangguan Server (500) - PT Erlass Prokreatif Indonesia')

@section('content')
<section class="min-h-[75vh] flex items-center justify-center bg-slate-50 relative overflow-hidden py-24">
    <div class="relative z-10 text-center px-4 max-w-xl mx-auto space-y-6">
        <span class="text-7xl sm:text-8xl font-black text-[#023047] tracking-tight block">500</span>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#023047]">
            Terjadi Kendala Teknis
        </h1>
        <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-md mx-auto">
            Sistem kami sedang mengalami kendala sementara saat memproses permintaan Anda. Tim teknis kami telah menerima laporan ini. Silakan coba kembali beberapa saat lagi.
        </p>
        <div class="pt-2">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-7 py-3 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow hover:shadow-orange-500/25 transition-all duration-200">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
