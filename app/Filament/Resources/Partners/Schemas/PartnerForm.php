<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PartnerForm
{
    public const LEVELS = ['TK' => 'TK', 'SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'SMK' => 'SMK', 'Umum' => 'Umum'];

    public const TYPES = ['school' => 'Sekolah', 'strategic' => 'Mitra strategis', 'technology' => 'Mitra teknologi'];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data sekolah')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->label('Nama sekolah')
                            ->required()->maxLength(255)
                            ->live(onBlur: true)
                            // New school: fill the link name automatically from the name and city
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state, string $operation) {
                                if ($operation === 'create' && blank($get('slug'))) {
                                    $set('slug', Str::slug($state.($get('city') ? '-'.$get('city') : '')));
                                }
                            }),
                        TextInput::make('slug')->label('Nama tautan (slug)')
                            ->required()->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Terisi otomatis dari nama sekolah. Huruf kecil dan tanda hubung saja.'),
                        Select::make('level')->label('Jenjang')->options(self::LEVELS)->native(false),
                        Select::make('type')->label('Jenis mitra')->options(self::TYPES)->default('school')->required()->native(false),
                        TextInput::make('city')->label('Kota/Kabupaten')->maxLength(100),
                        TextInput::make('province')->label('Provinsi')->maxLength(100),
                        TextInput::make('website')->label('Website sekolah')->url()->maxLength(255)->placeholder('https://'),
                        TextInput::make('kodlan')->label('Kode CRM (kodlan)')->maxLength(50)
                            ->unique(ignoreRecord: true)
                            ->helperText('Dari CRM. Boleh dikosongkan untuk sekolah yang ditambah manual.'),
                    ]),

                Section::make('Logo sekolah')
                    ->description('Tampil di deretan "Telah dipercaya oleh" di beranda. Tanpa logo, yang tampil adalah label jenjang (SD/SMP/…).')
                    ->schema([
                        FileUpload::make('logo_url')->label('Logo')
                            ->image()->imageEditor()
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                            ->maxSize(1024)
                            ->disk('uploads')->directory('uploads/partners')
                            ->helperText('PNG/WebP berlatar transparan paling bagus. Bentuk persegi, maks. 1 MB.'),
                    ]),

                Section::make('Tampilan di beranda')
                    ->columns(3)
                    ->schema([
                        Toggle::make('is_featured')->label('Tampilkan di beranda')
                            ->helperText('Maks. 40 sekolah yang tampil, urut dari angka urutan terkecil.')
                            ->default(false),
                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0)->required(),
                        TextInput::make('total_deals')->label('Jumlah program')->numeric()->minValue(0)->default(1)->required()
                            ->helperText('Tampil sebagai "… Program".'),
                    ]),
            ]);
    }
}
