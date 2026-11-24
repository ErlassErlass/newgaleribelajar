<?php

namespace App\Filament\Resources\ArticleComments;

use App\Filament\Resources\ArticleComments\Pages\ManageArticleComments;
use App\Models\ArticleComment;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use UnitEnum;

class ArticleCommentResource extends Resource
{
    protected static ?string $model = ArticleComment::class;

    protected static ?string $modelLabel = 'Komentar';

    protected static ?string $pluralModelLabel = 'Komentar';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static string|UnitEnum|null $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 2;

    /** Comments waiting for a decision (hidden ones, flagged or not). */
    public static function getNavigationBadge(): ?string
    {
        $count = ArticleComment::where('is_approved', false)->count();

        return $count ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return ArticleComment::where('is_flagged', true)->where('is_approved', false)->exists() ? 'danger' : 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama')->required()->maxLength(100),
            TextInput::make('email')->label('Email')->email()->disabled(),
            Textarea::make('body')->label('Komentar')->required()->rows(5)->maxLength(2000)->columnSpanFull(),
            Toggle::make('is_approved')->label('Tampilkan di situs'),
            Toggle::make('is_flagged')->label('Tandai perlu ditinjau'),
        ]);
    }

    public static function table(Table $table): Table
    {
        // Note: Filament injects closure parameters by name, so they must be called $query / $data / $record
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with('article:id,title,slug'))
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable()
                    ->description(fn (ArticleComment $record) => $record->email),
                TextColumn::make('body')->label('Komentar')->limit(90)->wrap()->searchable()
                    ->tooltip(fn (ArticleComment $record) => $record->body),
                TextColumn::make('article.title')->label('Artikel')->limit(40)
                    ->url(fn (ArticleComment $record) => $record->article ? route('articles.show', $record->article->slug).'#comment-'.$record->id : null, true),
                TextColumn::make('moderation_state')->label('Status')->badge()
                    ->state(fn (ArticleComment $record) => match (true) {
                        $record->is_approved => 'Tampil',
                        $record->is_flagged => 'Perlu Ditinjau',
                        default => 'Menunggu',
                    })
                    ->color(fn (string $state) => ['Tampil' => 'success', 'Perlu Ditinjau' => 'danger', 'Menunggu' => 'warning'][$state] ?? 'gray')
                    ->description(fn (ArticleComment $record) => $record->flag_reason),
                IconColumn::make('marketing_consent')->label('Izin promosi')->boolean()->toggleable(),
                TextColumn::make('created_at')->label('Dikirim')->since()->sortable(),
            ])
            ->filters([
                SelectFilter::make('moderation')->label('Status')
                    ->options(['pending' => 'Menunggu', 'flagged' => 'Perlu Ditinjau', 'approved' => 'Tampil'])
                    ->query(fn (Builder $query, array $data) => match ($data['value'] ?? null) {
                        'pending' => $query->where('is_approved', false)->where('is_flagged', false),
                        'flagged' => $query->where('is_flagged', true)->where('is_approved', false),
                        'approved' => $query->where('is_approved', true),
                        default => $query,
                    }),
            ])
            ->recordActions([
                Action::make('approve')->label('Tampilkan')->icon('heroicon-o-check')->color('success')
                    ->visible(fn (ArticleComment $record) => ! $record->is_approved)
                    ->action(fn (ArticleComment $record) => $record->update(['is_approved' => true, 'is_flagged' => false])),
                Action::make('hide')->label('Sembunyikan')->icon('heroicon-o-eye-slash')->color('gray')
                    ->visible(fn (ArticleComment $record) => $record->is_approved)
                    ->action(fn (ArticleComment $record) => $record->update(['is_approved' => false])),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('approveSelected')->label('Tampilkan terpilih')->icon('heroicon-o-check')
                        ->action(fn (Collection $records) => $records->each->update(['is_approved' => true, 'is_flagged' => false]))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('hideSelected')->label('Sembunyikan terpilih')->icon('heroicon-o-eye-slash')
                        ->action(fn (Collection $records) => $records->each->update(['is_approved' => false]))
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageArticleComments::route('/'),
        ];
    }
}
