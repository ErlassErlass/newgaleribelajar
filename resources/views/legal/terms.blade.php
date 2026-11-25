@extends('legal._layout')

@section('title', __('Syarat & Ketentuan - Erlass Academy'))
@section('description', __('Syarat dan ketentuan penggunaan website dan layanan PT Erlass Prokreatif Indonesia.'))
@section('legal_title', __('Syarat & Ketentuan'))
@section('legal_updated', '24 November 2026')

@section('legal_body')
<div>
    <p>{{ __('Dengan mengakses website ini, Anda menyetujui syarat dan ketentuan berikut. Jika tidak setuju, mohon untuk tidak menggunakan website ini.') }}</p>
</div>
<div>
    <h2>{{ __('1. Informasi di Website') }}</h2>
    <p>{{ __('Informasi produk, program, dan kegiatan disajikan sebagai gambaran umum. Spesifikasi, harga, dan jadwal resmi mengacu pada penawaran tertulis yang diterbitkan :company.', ['company' => config('erlass.company')]) }}</p>
</div>
<div>
    <h2>{{ __('2. Hak Kekayaan Intelektual') }}</h2>
    <p>{{ __('Seluruh konten di website ini — termasuk teks, logo, foto, kurikulum, dan materi pembelajaran — merupakan milik Erlass atau pemberi lisensinya dan tidak boleh digandakan atau didistribusikan tanpa izin tertulis.') }}</p>
</div>
<div>
    <h2>{{ __('3. Penggunaan Formulir') }}</h2>
    <ul>
        <li>{{ __('Anda bertanggung jawab atas kebenaran data yang dikirimkan melalui formulir konsultasi.') }}</li>
        <li>{{ __('Dilarang menggunakan formulir untuk spam, promosi pihak lain, atau tujuan yang melanggar hukum.') }}</li>
    </ul>
</div>
<div>
    <h2>{{ __('4. Kerja Sama Program') }}</h2>
    <p>{{ __('Kerja sama program dengan sekolah, yayasan, atau instansi diatur dalam perjanjian tersendiri yang disepakati kedua belah pihak.') }}</p>
</div>
<div>
    <h2>{{ __('5. Tautan Pihak Ketiga') }}</h2>
    <p>{{ __('Website ini dapat memuat tautan ke layanan pihak ketiga (misalnya WhatsApp, Instagram, TikTok, YouTube). Kami tidak bertanggung jawab atas konten maupun kebijakan privasi layanan tersebut.') }}</p>
</div>
<div>
    <h2>{{ __('6. Perubahan Ketentuan') }}</h2>
    <p>{{ __('Kami dapat memperbarui syarat dan ketentuan ini sewaktu-waktu. Penggunaan website setelah perubahan berarti Anda menyetujui ketentuan yang baru.') }}</p>
</div>
<div>
    <h2>{{ __('7. Hukum yang Berlaku') }}</h2>
    <p>{{ __('Syarat dan ketentuan ini tunduk pada hukum Republik Indonesia.') }}</p>
</div>
@endsection
