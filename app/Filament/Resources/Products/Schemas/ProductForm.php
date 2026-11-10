<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name'),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('summary'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('product_type'),
                TextInput::make('education_levels'),
                TextInput::make('features'),
                FileUpload::make('cover_image')
                    ->image(),
                TextInput::make('status')
                    ->required()
                    ->default('published'),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('deal_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
