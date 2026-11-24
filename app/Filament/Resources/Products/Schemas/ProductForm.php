<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Informasi Produk')->columnSpan(2)->columns(2)->schema([
                    TextInput::make('name')->label('Nama produk')->required()->maxLength(255)->columnSpanFull(),
                    TextInput::make('sku')->label('Kode (SKU)')->required()->unique(ignoreRecord: true)->maxLength(50),
                    TextInput::make('slug')->label('Slug URL')->required()->alphaDash()->unique(ignoreRecord: true)
                        ->placeholder('modul-scratch-jilid-1')
                        ->helperText('Alamat: /katalog/slug. Huruf kecil dan tanda hubung. Jangan diubah setelah dibagikan.'),
                    Select::make('category_id')->label('Kategori')->relationship('category', 'name')->searchable()->preload(),
                    Select::make('product_type')->label('Jenis')->options(['Fisik' => 'Produk Fisik', 'Jasa' => 'Program / Layanan'])->required(),
                    TextInput::make('author')->label('Penulis / penerbit (opsional)')->columnSpanFull(),
                    Textarea::make('summary')->label('Ringkasan')->maxLength(500)->rows(2)->columnSpanFull()
                        ->placeholder('Buku kerja coding Scratch untuk siswa SD kelas 1 dengan proyek animasi dan game sederhana, selaras Kurikulum Merdeka.')
                        ->helperText('1 kalimat (± 150 karakter): produk apa, untuk siapa, manfaat utamanya. Dipakai di halaman produk, FAQ {ringkasan}, dan Google bila Meta description kosong.')
                        ->live(onBlur: true)
                        ->hint(fn (?string $state) => mb_strlen((string) $state).' karakter'),
                    Textarea::make('description')->label('Deskripsi')->rows(4)->columnSpanFull()
                        ->placeholder('Modul Scratch Jilid 1 berisi 12 bab latihan bertahap: mengenal blok gerak, membuat animasi, hingga game tangkap bola...')
                        ->helperText('Penjelasan lengkap: isi, cara pakai di kelas, dan apa yang didapat sekolah.'),
                    CheckboxList::make('education_levels')->label('Jenjang')->options(['SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'SMK' => 'SMK'])->columns(4)->columnSpanFull(),
                    TagsInput::make('features')->label('Yang didapat sekolah (poin)')->columnSpanFull(),
                ]),

                Section::make('Tampilan & Status')->columnSpan(1)->schema([
                    FileUpload::make('cover_image')->label('Foto produk')
                        ->image()->imageEditor()->maxSize(2048)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->disk('uploads')->directory('uploads/products')
                        ->helperText('Kosongkan untuk memakai sampul otomatis. Rasio 3:4, maks. 2 MB.'),
                    Select::make('status')->options(['published' => 'Tampil', 'draft' => 'Disembunyikan'])->default('published')->required(),
                    Toggle::make('is_featured')->label('Unggulan (carousel beranda)'),
                    TextInput::make('deal_count')->label('Jumlah sekolah pengguna')->numeric()->default(0)->minValue(0),
                    TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                ]),

                Section::make('Penjualan & Platform')->columnSpan(2)->columns(2)->schema([
                    Toggle::make('on_shopee')->label('Tersedia di Shopee')->live(),
                    TextInput::make('shopee_url')->label('Link produk di Shopee')->url()
                        ->helperText('Kosongkan untuk mengarah ke halaman toko.')
                        ->visible(fn (Get $get) => $get('on_shopee')),
                    Toggle::make('on_lms')->label('Produk LMS Erlass Academy')->live(),
                    Select::make('lms_group')->label('Kolom di beranda (bagian LMS)')
                        ->options(fn () => \App\Models\LmsGroup::options())
                        ->placeholder('Tidak ditampilkan di bagian LMS')
                        ->helperText('Kolom bisa ditambah/diubah di Katalog › Kolom Produk LMS.')
                        ->visible(fn (Get $get) => $get('on_lms')),
                    TextInput::make('lms_url')->label('Link di LMS')->url()->visible(fn (Get $get) => $get('on_lms')),
                    Toggle::make('is_free')->label('Gratis'),
                ]),

                Section::make('Pertanyaan Umum (FAQ) Produk')
                    ->description('Template berlaku untuk semua produk dan diatur di menu Katalog › Pertanyaan (FAQ). Di sini Anda bisa memakai template, menggantinya, atau menambah pertanyaan khusus.')
                    ->columnSpan(2)
                    ->schema([
                        Select::make('faq_mode')->label('Sumber pertanyaan')
                            ->options(Product::FAQ_MODES)->default('template')->required()->live(),
                        TextEntry::make('faq_template_preview')->label('Pratinjau template untuk produk ini')
                            ->state(fn (?Product $record) => $record
                                ? collect((clone $record)->forceFill(['faq_mode' => 'template'])->faqItems())
                                    ->map(fn ($f, $i) => ($i + 1).'. '.$f[0])->implode("\n")
                                : 'Simpan produk dulu untuk melihat pratinjau.')
                            ->extraAttributes(['style' => 'white-space: pre-line'])
                            ->visible(fn (Get $get) => $get('faq_mode') !== 'custom'),
                        Repeater::make('faqs')->label('Pertanyaan khusus produk ini')
                            ->schema([
                                TextInput::make('question')->label('Pertanyaan')->required()->maxLength(255),
                                Textarea::make('answer')->label('Jawaban')->required()->rows(3),
                            ])
                            ->addActionLabel('Tambah pertanyaan')
                            ->reorderable()->collapsible()
                            ->itemLabel(fn (array $state) => $state['question'] ?? null)
                            ->helperText('Boleh memakai variabel seperti {produk}, {jenjang}, {whatsapp}, {info_pembelian}.')
                            ->visible(fn (Get $get) => $get('faq_mode') !== 'template'),
                    ]),

                Section::make('SEO (opsional)')->description('Teks yang tampil di hasil pencarian Google. Boleh dikosongkan: sistem membuatnya otomatis dari nama dan ringkasan.')->columnSpan(2)->columns(2)->collapsed()->schema([
                    TextInput::make('meta_title')->label('Judul di Google (meta title)')->maxLength(160)->columnSpanFull()
                        ->placeholder('Modul Scratch Jilid 1 untuk SD – Belajar Coding')
                        ->helperText('Ideal maks. 40 karakter; "| Katalog Erlass Academy" ditambahkan otomatis. Kosong = "Nama produk (kode)".')
                        ->live(onBlur: true)
                        ->hint(fn (?string $state) => mb_strlen((string) $state).'/40 karakter')
                        ->hintColor(fn (?string $state) => mb_strlen((string) $state) > 40 ? 'danger' : 'gray'),
                    Textarea::make('meta_description')->label('Deskripsi di Google (meta description)')->maxLength(300)->rows(2)->columnSpanFull()
                        ->placeholder('Modul Scratch Jilid 1 untuk siswa SD kelas 1: belajar coding visual lewat proyek seru, sesuai Kurikulum Merdeka. Dipakai 300+ sekolah. Pesan via WA atau Shopee.')
                        ->helperText('Ideal 120–155 karakter: manfaat, jenjang, bukti (jumlah sekolah), dan ajakan. Kosong = dibuat otomatis dari ringkasan.')
                        ->live(onBlur: true)
                        ->hint(fn (?string $state) => mb_strlen((string) $state).'/155 karakter')
                        ->hintColor(fn (?string $state) => mb_strlen((string) $state) > 155 ? 'danger' : 'gray'),
                ]),
            ]);
    }
}
