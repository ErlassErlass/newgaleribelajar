<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Program')
                    ->helperText('Contoh: Ekstrakurikuler Robotik')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->label('URL Slug')
                    ->helperText('Otomatis menyesuaikan nama program. (Contoh: ekstrakurikuler-robotik)')
                    ->required()
                    ->readOnly()
                    ->unique(ignoreRecord: true),
                Textarea::make('short_description')
                    ->label('Deskripsi Singkat (Tampil di Home)')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Konten Detail Program')
                    ->columnSpanFull(),
                FileUpload::make('thumbnail_image')
                    ->label('Foto Sampul')
                    ->image()
                    ->directory('programs'),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }
}
