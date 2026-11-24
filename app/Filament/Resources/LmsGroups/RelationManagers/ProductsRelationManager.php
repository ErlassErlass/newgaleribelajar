<?php

namespace App\Filament\Resources\LmsGroups\RelationManagers;

use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

/** Products shown in this LMS column: add, remove, and drag to reorder. */
class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $title = 'Produk dalam kolom ini';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->reorderable('lms_order')
            ->defaultSort('lms_order')
            ->paginated(false)
            ->description('Seret ikon ⠿ untuk mengubah urutan. Satu produk hanya bisa berada di satu kolom.')
            ->columns([
                ImageColumn::make('cover')->label('')
                    ->state(fn (Product $record) => $record->cover_url)->imageHeight(48),
                TextColumn::make('name')->label('Produk')->searchable()
                    ->description(fn (Product $record) => $record->levels_label),
                ToggleColumn::make('on_shopee')->label('Label Shopee'),
                TextColumn::make('status')->badge()
                    ->formatStateUsing(fn ($state) => $state === 'published' ? 'Tampil' : 'Disembunyikan')
                    ->color(fn ($state) => $state === 'published' ? 'success' : 'gray'),
            ])
            ->headerActions([
                AssociateAction::make()
                    ->label('Tambah produk ke kolom')
                    ->multiple()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['name', 'sku'])
                    // Offer every product not yet in this column (one that sits in another column is moved here)
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query
                        ->where(fn ($q) => $q->whereNull('lms_group')->orWhere('lms_group', '!=', $this->getOwnerRecord()->slug))
                        ->orderBy('name')),
            ])
            ->recordActions([
                Action::make('editProduct')->label('Edit produk')->icon('heroicon-o-pencil-square')->color('gray')
                    ->url(fn (Product $record) => \App\Filament\Resources\Products\ProductResource::getUrl('edit', ['record' => $record])),
                DissociateAction::make()->label('Keluarkan'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DissociateBulkAction::make()->label('Keluarkan terpilih')]),
            ]);
    }
}
