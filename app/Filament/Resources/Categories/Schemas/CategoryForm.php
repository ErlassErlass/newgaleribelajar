<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kategori produk')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->label('Nama kategori')
                            ->required()->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state, string $operation) {
                                if ($operation === 'create' && blank($get('slug'))) {
                                    $set('slug', Str::slug((string) $state));
                                }
                            }),
                        TextInput::make('slug')->label('Nama tautan (slug)')
                            ->required()->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Terisi otomatis dari nama. Dipakai di alamat filter katalog.'),
                        Textarea::make('description')->label('Deskripsi')->rows(3)->columnSpanFull(),
                        TextInput::make('icon')->label('Ikon')
                            ->helperText('Nama ikon, mis. cpu, book-open, clipboard-check.'),
                        TextInput::make('crm_id')->label('ID CRM')->numeric()
                            ->helperText('Dari CRM. Boleh dikosongkan.'),
                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0)->required(),
                        Toggle::make('is_active')->label('Aktif (tampil di situs)')->default(true),
                    ]),
            ]);
    }
}
