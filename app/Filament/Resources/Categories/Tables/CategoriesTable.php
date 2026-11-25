<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('name')->label('Nama kategori')->searchable()->sortable(),
                TextColumn::make('products_count')->label('Produk')->counts('products')->sortable(),
                TextColumn::make('slug')->label('Slug')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('icon')->label('Ikon')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('crm_id')->label('ID CRM')->numeric()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sort_order')->label('Urutan')->numeric()->sortable(),
                ToggleColumn::make('is_active')->label('Aktif'),
                TextColumn::make('updated_at')->label('Diubah')->since()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\TernaryFilter::make('is_active')->label('Aktif'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
