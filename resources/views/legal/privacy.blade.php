@extends('legal._layout')

@section('title', __('Kebijakan Privasi - Erlass Academy'))
@section('description', __('Kebijakan privasi PT Erlass Prokreatif Indonesia mengenai pengumpulan dan pemrosesan data pribadi pengunjung website.'))
@section('legal_title', __('Kebijakan Privasi'))
@section('legal_updated', '24 November 2026')

@section('legal_body')
<div>
    <p>{{ __(':company ("Erlass", "kami") menghargai privasi setiap pengunjung website dan mitra kami. Kebijakan ini menjelaskan data apa yang kami kumpulkan, bagaimana data tersebut digunakan, dan hak Anda sesuai Undang-Undang No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP).', ['company' => config('erlass.company')]) }}</p>
</div>
<div>
    <h2>{{ __('1. Data yang Kami Kumpulkan') }}</h2>
    <ul>
        <li>{{ __('Data yang Anda isi pada formulir konsultasi: nama, nomor WhatsApp/telepon, email, nama sekolah/instansi, kota, perkiraan jumlah siswa, program yang diminati, dan pesan.') }}</li>
        <li>{{ __('Data teknis dasar seperti alamat IP dan jenis peramban yang tercatat otomatis untuk keamanan dan pencegahan spam.') }}</li>
    </ul>
</div>
<div>
    <h2>{{ __('2. Tujuan Penggunaan Data') }}</h2>
    <ul>
        <li>{{ __('Menghubungi Anda untuk konsultasi program, demonstrasi, dan penawaran resmi.') }}</li>
        <li>{{ __('Menyusun proposal kerja sama yang sesuai dengan kebutuhan sekolah atau instansi Anda.') }}</li>
        <li>{{ __('Menjaga keamanan website dan mencegah penyalahgunaan formulir.') }}</li>
    </ul>
</div>
<div>
    <h2>{{ __('3. Dasar Pemrosesan & Persetujuan') }}</h2>
    <p>{{ __('Kami memproses data berdasarkan persetujuan yang Anda berikan saat mengirim formulir. Anda dapat menarik persetujuan kapan saja dengan menghubungi kami.') }}</p>
</div>
<div>
    <h2>{{ __('4. Penyimpanan & Keamanan') }}</h2>
    <p>{{ __('Data disimpan pada sistem internal dengan akses terbatas bagi tim yang berwenang dan hanya selama diperlukan untuk tujuan di atas. Kami tidak menjual data pribadi Anda kepada pihak mana pun.') }}</p>
</div>
<div>
    <h2>{{ __('5. Hak Anda') }}</h2>
    <ul>
        <li>{{ __('Meminta akses dan salinan data pribadi Anda.') }}</li>
        <li>{{ __('Meminta perbaikan data yang tidak akurat.') }}</li>
        <li>{{ __('Meminta penghapusan data atau menarik persetujuan pemrosesan.') }}</li>
    </ul>
</div>
<div>
    <h2>{{ __('6. Perubahan Kebijakan') }}</h2>
    <p>{{ __('Kebijakan ini dapat diperbarui sewaktu-waktu. Versi terbaru selalu tersedia di halaman ini.') }}</p>
</div>
@endsection
