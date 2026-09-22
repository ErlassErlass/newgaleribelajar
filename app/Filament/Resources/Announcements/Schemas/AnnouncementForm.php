<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('content')
                    ->label('Teks Pengumuman')
                    ->required(),
                TextInput::make('url_link')
                    ->label('Tautan URL (Opsional)'),
                Toggle::make('is_active')
                    ->label('Status Tayang Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }
}
