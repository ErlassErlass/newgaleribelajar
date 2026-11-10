<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kodlan'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('city'),
                TextInput::make('province'),
                TextInput::make('level'),
                TextInput::make('type')
                    ->required()
                    ->default('school'),
                TextInput::make('logo_url')
                    ->url(),
                TextInput::make('website')
                    ->url(),
                TextInput::make('total_deals')
                    ->required()
                    ->numeric()
                    ->default(1),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
