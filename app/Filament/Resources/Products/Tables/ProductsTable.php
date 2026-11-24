<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->with('category'))
            ->defaultSort('sort_order')
            ->columns([
                ImageColumn::make('cover')->label('Sampul')
                    ->state(fn (Product $record) => $record->cover_url)->imageHeight(56),
                TextColumn::make('name')->label('Produk')->searchable()->wrap()
                    ->description(fn (Product $record) => $record->sku),
                TextColumn::make('sku')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('category.name')->label('Kategori')->toggleable(),
                TextColumn::make('product_type')->label('Jenis')->badge(),
                ToggleColumn::make('on_shopee')->label('Shopee'),
                ToggleColumn::make('on_lms')->label('LMS'),
                ToggleColumn::make('is_featured')->label('Unggulan'),
                TextColumn::make('status')->badge()
                    ->formatStateUsing(fn ($state) => $state === 'published' ? 'Tampil' : 'Disembunyikan')
                    ->color(fn ($state) => $state === 'published' ? 'success' : 'gray'),
                TextColumn::make('deal_count')->label('Sekolah')->numeric()->sortable(),
                TextColumn::make('views')->label('Dilihat')->numeric()->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')->label('Kategori')->relationship('category', 'name'),
                SelectFilter::make('status')->options(['published' => 'Tampil', 'draft' => 'Disembunyikan']),
                TernaryFilter::make('on_shopee')->label('Di Shopee'),
                TernaryFilter::make('on_lms')->label('Produk LMS'),
            ])
            ->recordActions([
                Action::make('view')->label('Lihat')->icon('heroicon-o-arrow-top-right-on-square')->color('gray')
                    ->url(fn (Product $record) => route('products.show', $record->slug), true),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
