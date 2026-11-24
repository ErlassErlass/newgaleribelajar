<?php

namespace App\Filament\Resources\Faqs;

use App\Filament\Resources\Faqs\Pages\ManageFaqs;
use App\Models\Faq;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use UnitEnum;

/**
 * Pertanyaan Seputar Katalog (/katalog) and the template FAQ shown on every product page.
 * Products can replace or extend the template with their own questions (Produk > Pertanyaan Umum).
 */
class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $modelLabel = 'Pertanyaan (FAQ)';

    protected static ?string $pluralModelLabel = 'Pertanyaan (FAQ)';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Katalog';

    protected static ?int $navigationSort = 4;

    public static function placeholderHelp(): HtmlString
    {
        $rows = collect(Faq::PLACEHOLDERS)
            ->map(fn ($desc, $tag) => '<code style="font-weight:600">'.e($tag).'</code> '.e($desc))
            ->implode('<br>');

        return new HtmlString('<div style="font-size:12px;line-height:1.7">Variabel yang bisa dipakai di pertanyaan & jawaban:<br>'.$rows.'</div>');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('scope')->label('Ditampilkan di')->options(Faq::SCOPES)->required()
                ->default(fn ($livewire) => $livewire->activeTab ?? Faq::SCOPE_CATALOG),
            TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
            TextInput::make('question')->label('Pertanyaan')->required()->maxLength(255)->columnSpanFull(),
            Textarea::make('answer')->label('Jawaban')->required()->rows(5)->columnSpanFull(),
            Toggle::make('is_active')->label('Tampilkan')->default(true),
            Text::make(self::placeholderHelp())->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('question')->label('Pertanyaan')->wrap()->searchable()
                    ->description(fn (Faq $record) => str($record->answer)->limit(110)),
                TextColumn::make('scope')->label('Ditampilkan di')->badge()
                    ->formatStateUsing(fn ($state) => Faq::SCOPES[$state] ?? $state),
                ToggleColumn::make('is_active')->label('Tampil'),
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => ManageFaqs::route('/')];
    }
}
