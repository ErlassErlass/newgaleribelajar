<?php

namespace App\Filament\Resources\Articles\Tables;

use App\Filament\Resources\Articles\ArticleActions;
use App\Models\Article;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // Same order as the public listing: pinned first
            ->modifyQueryUsing(fn ($query) => $query->with('author')->pinnedFirst())
            ->columns([
                ImageColumn::make('cover_image')->label('Sampul')->disk('uploads')->square(),
                TextColumn::make('title')->label('Judul')->searchable()->wrap()->limit(70)
                    ->description(fn (Article $record) => \App\Models\ArticleCategory::options(false)[$record->category] ?? $record->category),
                TextColumn::make('status')->label('Status')->badge()
                    ->formatStateUsing(fn ($state) => Article::STATUSES[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        Article::STATUS_PUBLISHED => 'success',
                        Article::STATUS_REVIEW => 'info',
                        Article::STATUS_REJECTED => 'warning',
                        default => 'gray',
                    }),
                IconColumn::make('is_pinned')->label('Pin')->boolean()->trueIcon('heroicon-s-bookmark')->falseIcon(''),
                TextColumn::make('author.name')->label('Penulis')->placeholder('-')->toggleable(),
                TextColumn::make('published_at')->label('Terbit')->dateTime('d M Y')->sortable()->toggleable(),
                TextColumn::make('views')->label('Dilihat')->numeric()->sortable()->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')->label('Status')->options(Article::STATUSES),
                SelectFilter::make('category')->label('Kategori')->options(fn () => \App\Models\ArticleCategory::options()),
                TernaryFilter::make('is_pinned')->label('Disematkan'),
            ])
            ->recordActions([
                ActionGroup::make(ArticleActions::all()),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
