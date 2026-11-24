<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        $categories = config('gallery.categories', []);

        return $schema
            ->components([
                FileUpload::make('image_path')->label('Foto')
                    ->image()->imageEditor()->required()->maxSize(3072)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->disk('uploads')->directory('uploads/gallery')
                    ->helperText('JPG/PNG/WebP, maks. 3 MB.')
                    ->columnSpanFull(),
                TextInput::make('title')->label('Judul')->required()->maxLength(255),
                DatePicker::make('taken_at')->label('Tanggal kegiatan'),
                Select::make('category')->label('Kategori')
                    ->options(collect($categories)->map(fn ($c) => $c['label']))
                    ->required()->live()
                    ->afterStateUpdated(fn (Set $set) => $set('subcategory', null)),
                Select::make('subcategory')->label('Sub-kategori')
                    ->options(fn (Get $get) => $categories[$get('category')]['subs'] ?? [])
                    ->disabled(fn (Get $get) => blank($get('category'))),
                Textarea::make('description')->label('Keterangan')->maxLength(300)->rows(2)->columnSpanFull(),
                Toggle::make('is_active')->label('Tampilkan')->default(true),
                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
            ]);
    }
}
