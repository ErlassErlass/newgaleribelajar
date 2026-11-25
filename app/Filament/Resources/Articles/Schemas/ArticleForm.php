<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        $isAdmin = fn () => auth()->user()?->isAdmin() ?? false;

        return $schema
            ->columns(3)
            ->components([
                Section::make('Isi Artikel')
                    ->columnSpan(2)
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, Set $set, string $operation) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug((string) $state));
                                }
                            })
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('lomba-robotika-sd-2026')
                            ->helperText('Alamat artikel: /artikel/slug. Huruf kecil dan tanda hubung, 3–6 kata kunci. Jangan diubah setelah terbit, karena link yang sudah dibagikan akan rusak.'),
                        Select::make('category')
                            ->label('Kategori')
                            ->options(fn () => \App\Models\ArticleCategory::options())
                            ->default('artikel')
                            ->required(),
                        FileUpload::make('cover_image')
                            ->label('Gambar sampul')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->disk('uploads')
                            ->directory('uploads/articles')
                            ->helperText('JPG/PNG/WebP, maks. 2 MB. Disarankan 1600×1000 px.')
                            ->columnSpanFull(),
                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->maxLength(500)
                            ->rows(3)
                            ->placeholder('Erlass Coding & Robotic Competition 2026 dibuka untuk siswa SD–SMA. Simak jadwal, kategori lomba, dan cara mendaftarkan tim sekolah Anda.')
                            ->helperText('1–2 kalimat (± 150 karakter). Tampil di kartu artikel dan dipakai Google bila Meta description dikosongkan.')
                            ->live(onBlur: true)
                            ->hint(fn (?string $state) => mb_strlen((string) $state).' karakter')
                            ->columnSpanFull(),
                        Textarea::make('body')
                            ->label('Isi artikel')
                            ->helperText('Pisahkan paragraf dengan satu baris kosong.')
                            ->required()
                            ->rows(16)
                            ->columnSpanFull(),
                        TagsInput::make('tags')
                            ->label('Hashtag (tanpa #)')
                            ->placeholder('KompetisiRobotika')
                            ->helperText('3–6 hashtag tanpa # dan tanpa spasi, tiap kata diawali huruf kapital, mis. KompetisiRobotika, CodingAnak, Microbit. Tekan Enter setiap selesai satu hashtag.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Penerbitan')
                    ->columnSpan(1)
                    ->schema([
                        TextEntry::make('status_info')
                            ->label('Status')
                            ->state(fn (?Article $record) => $record?->status_label ?? 'Draf (baru)'),
                        TextEntry::make('review_note_info')
                            ->label('Catatan revisi dari Admin')
                            ->state(fn (?Article $record) => $record?->review_note)
                            ->visible(fn (?Article $record) => filled($record?->review_note)),
                        Select::make('status')
                            ->label('Ubah status')
                            ->options(Article::STATUSES)
                            ->visible($isAdmin)
                            ->helperText('Content Writer mengajukan artikel; Admin menyetujui di sini atau lewat tombol Setujui.'),
                        DateTimePicker::make('published_at')
                            ->label('Tanggal terbit')
                            ->visible($isAdmin),
                        Toggle::make('is_pinned')
                            ->label('Sematkan di urutan teratas')
                            ->helperText('Hanya untuk artikel yang sudah terbit.')
                            ->visible($isAdmin),
                        TextEntry::make('author_info')
                            ->label('Penulis')
                            ->state(fn (?Article $record) => $record?->author?->name ?? auth()->user()?->name),
                    ]),

                Section::make('Versi Bahasa Inggris (EN)')
                    ->description('Tampil saat pengunjung memilih EN English. Kosongkan = artikel tampil dalam bahasa Indonesia.')
                    ->columnSpan(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('title_en')->label('Judul (English)')->maxLength(255),
                        Textarea::make('excerpt_en')->label('Ringkasan (English)')->maxLength(500)->rows(3),
                        Textarea::make('body_en')->label('Isi artikel (English)')
                            ->helperText('Pisahkan paragraf dengan satu baris kosong, sama seperti versi Indonesia.')
                            ->rows(16),
                    ]),

                Section::make('SEO (opsional)')
                    ->description('Teks yang tampil di hasil pencarian Google. Boleh dikosongkan: sistem memakai Judul dan Ringkasan.')
                    ->columnSpan(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')->label('Judul di Google (meta title)')
                            ->maxLength(70)
                            ->placeholder('Erlass Robotic Competition 2026: Jadwal & Cara Daftar')
                            ->helperText('Ideal 40–45 karakter; "| Erlass Academy" ditambahkan otomatis. Letakkan kata kunci utama di depan.')
                            ->live(onBlur: true)
                            ->hint(fn (?string $state) => mb_strlen((string) $state).'/45 karakter')
                            ->hintColor(fn (?string $state) => mb_strlen((string) $state) > 45 ? 'danger' : 'gray'),
                        Textarea::make('meta_description')->label('Deskripsi di Google (meta description)')
                            ->maxLength(170)
                            ->rows(2)
                            ->placeholder('Daftarkan tim sekolah Anda di Erlass Coding & Robotic Competition 2026. Lihat jadwal, kategori lomba SD–SMA, dan cara pendaftaran di sini.')
                            ->helperText('Ideal 120–155 karakter. Jelaskan isi artikel dan ajak membaca; sebut kata kunci sekali secara alami.')
                            ->live(onBlur: true)
                            ->hint(fn (?string $state) => mb_strlen((string) $state).'/155 karakter')
                            ->hintColor(fn (?string $state) => mb_strlen((string) $state) > 155 ? 'danger' : 'gray'),
                    ]),
            ]);
    }
}
