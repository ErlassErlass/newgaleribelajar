<?php

namespace App\Filament\Resources\Galleries\Tables;

use App\Models\Gallery;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                ImageColumn::make('image_path')->label('Foto')->disk('uploads')->imageHeight(64),
                TextColumn::make('title')->label('Judul')->searchable()->wrap(),
                TextColumn::make('category')->label('Kategori')->badge()
                    ->formatStateUsing(fn ($state) => config("gallery.categories.$state.label", $state)),
                TextColumn::make('subcategory')->label('Sub-kategori')
                    ->state(fn (Gallery $record) => $record->subcategory_label)->placeholder('-'),
                ToggleColumn::make('is_active')->label('Tampil'),
                TextColumn::make('taken_at')->label('Tanggal')->date('d M Y')->sortable()->toggleable(),
            ])
            ->filters([
                SelectFilter::make('category')->label('Kategori')
                    ->options(collect(config('gallery.categories'))->map(fn ($c) => $c['label'])),
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
