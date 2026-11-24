<?php

namespace App\Filament\Resources\ArticleCategories;

use App\Filament\Resources\ArticleCategories\Pages\ManageArticleCategories;
use App\Models\ArticleCategory;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

/** Admin & Super Admin (ArticleCategoryPolicy). */
class ArticleCategoryResource extends Resource
{
    protected static ?string $model = ArticleCategory::class;

    protected static ?string $modelLabel = 'Kategori Artikel';

    protected static ?string $pluralModelLabel = 'Kategori Artikel';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

    protected static string|UnitEnum|null $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama kategori')->required()->maxLength(100)
                ->live(onBlur: true)
                ->afterStateUpdated(function (?string $state, Set $set, string $operation) {
                    if ($operation === 'create') {
                        $set('slug', Str::slug((string) $state));
                    }
                }),
            TextInput::make('slug')->label('Slug URL')->required()->alphaDash()->maxLength(60)
                ->unique(ignoreRecord: true)
                ->helperText('Dipakai di alamat /artikel?kategori=... Mengubahnya akan memindahkan artikel ke slug baru.'),
            Textarea::make('description')->label('Deskripsi')->maxLength(300)->rows(2)->columnSpanFull(),
            TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
            Toggle::make('is_active')->label('Aktif')->default(true)
                ->helperText('Kategori nonaktif tidak muncul di filter & form, artikel lamanya tetap tampil.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable()
                    ->description(fn (ArticleCategory $record) => '/artikel?kategori='.$record->slug),
                TextColumn::make('articles_count')->label('Artikel')->counts('articles'),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    // Keep categories that still hold articles (deactivate them instead)
                    ->disabled(fn (ArticleCategory $record) => $record->articles()->exists())
                    ->tooltip(fn (ArticleCategory $record) => $record->articles()->exists() ? 'Masih dipakai artikel; nonaktifkan saja' : null),
            ]);
    }

    public static function getPages(): array
    {
        return ['index' => ManageArticleCategories::route('/')];
    }
}
