<?php

namespace App\Filament\Resources\LmsGroups;

use App\Filament\Resources\LmsGroups\Pages\CreateLmsGroup;
use App\Filament\Resources\LmsGroups\Pages\EditLmsGroup;
use App\Filament\Resources\LmsGroups\Pages\ListLmsGroups;
use App\Filament\Resources\LmsGroups\RelationManagers\ProductsRelationManager;
use App\Models\LmsGroup;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use UnitEnum;

/**
 * Columns of the homepage "Produk Digital di LMS Erlass Academy" section
 * (Intrakurikuler / Course / Asesmen ...) and which products sit in each one.
 */
class LmsGroupResource extends Resource
{
    protected static ?string $model = LmsGroup::class;

    protected static ?string $modelLabel = 'Kolom Produk LMS';

    protected static ?string $pluralModelLabel = 'Kolom Produk LMS';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedViewColumns;

    protected static string|UnitEnum|null $navigationGroup = 'Katalog';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Judul kolom')->required()->maxLength(100)
                ->placeholder('Intrakurikuler dengan LMS')
                ->live(onBlur: true)
                ->afterStateUpdated(function (?string $state, Set $set, string $operation) {
                    if ($operation === 'create') {
                        $set('slug', Str::slug((string) $state));
                    }
                }),
            TextInput::make('slug')->label('Kode kolom')->required()->alphaDash()->maxLength(60)
                ->unique(ignoreRecord: true)
                ->rule(Rule::notIn([LmsGroup::BANNER]))
                ->helperText('Huruf kecil dan tanda hubung, mis. "pelatihan-guru".'),
            Textarea::make('description')->label('Deskripsi singkat')->maxLength(300)->rows(2)->columnSpanFull()
                ->placeholder('Mata pelajaran Informatika dan Koding & KA siap pakai untuk jam pelajaran reguler.'),
            ColorPicker::make('color')->label('Warna penanda')->default('#219ebc')
                ->helperText('Garis warna di samping judul kolom.'),
            TextInput::make('sort_order')->label('Urutan kolom')->numeric()->default(0),
            Toggle::make('is_active')->label('Tampilkan di beranda')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                ColorColumn::make('color')->label(''),
                TextColumn::make('title')->label('Kolom')->searchable()
                    ->description(fn (LmsGroup $record) => $record->description),
                TextColumn::make('products_count')->label('Produk')->counts('products')->badge(),
                ToggleColumn::make('is_active')->label('Tampil'),
            ])
            ->recordActions([
                EditAction::make()->label('Atur kolom & produk'),
                DeleteAction::make()
                    ->modalDescription('Produk di kolom ini tidak ikut terhapus; mereka hanya dikeluarkan dari kolom.'),
            ]);
    }

    public static function getRelations(): array
    {
        return [ProductsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLmsGroups::route('/'),
            'create' => CreateLmsGroup::route('/create'),
            'edit' => EditLmsGroup::route('/{record}/edit'),
        ];
    }
}
