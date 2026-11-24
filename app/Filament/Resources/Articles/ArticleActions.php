<?php

namespace App\Filament\Resources\Articles;

use App\Models\Article;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Gate;

/** Review workflow buttons, shared by the article table and the edit page. */
class ArticleActions
{
    /** @return Action[] */
    public static function all(): array
    {
        return [self::submit(), self::approve(), self::reject(), self::unpublish(), self::togglePin()];
    }

    /** Writer: send a draft (or a revised article) to the admins. */
    public static function submit(): Action
    {
        return Action::make('submitForReview')
            ->label('Ajukan Persetujuan')
            ->icon('heroicon-o-paper-airplane')
            ->color('info')
            ->requiresConfirmation()
            ->modalDescription('Artikel dikirim ke Admin untuk ditinjau. Selama menunggu, artikel tidak bisa diubah.')
            ->visible(fn (Article $record) => Gate::allows('submitForReview', $record))
            ->action(function (Article $record) {
                $record->update(['status' => Article::STATUS_REVIEW, 'review_note' => null]);
                Notification::make()->title('Artikel diajukan untuk persetujuan')->success()->send();
            });
    }

    /** Admin: approve and publish. */
    public static function approve(): Action
    {
        return Action::make('approve')
            ->label('Setujui & Terbitkan')
            ->icon('heroicon-o-check-badge')
            ->color('success')
            ->requiresConfirmation()
            ->visible(fn (Article $record) => Gate::allows('publish', $record) && $record->status !== Article::STATUS_PUBLISHED)
            ->action(function (Article $record) {
                $record->update([
                    'status' => Article::STATUS_PUBLISHED,
                    'reviewed_by' => auth()->id(),
                    'reviewed_at' => now(),
                    'review_note' => null,
                ]);
                Notification::make()->title('Artikel diterbitkan')->success()->send();
            });
    }

    /** Admin: send back to the writer with a note. */
    public static function reject(): Action
    {
        return Action::make('reject')
            ->label('Minta Revisi')
            ->icon('heroicon-o-arrow-uturn-left')
            ->color('warning')
            ->schema([
                Textarea::make('review_note')->label('Catatan untuk penulis')->required()->maxLength(500),
            ])
            ->visible(fn (Article $record) => Gate::allows('publish', $record) && $record->status === Article::STATUS_REVIEW)
            ->action(function (Article $record, array $data) {
                $record->update([
                    'status' => Article::STATUS_REJECTED,
                    'reviewed_by' => auth()->id(),
                    'reviewed_at' => now(),
                    'review_note' => $data['review_note'],
                ]);
                Notification::make()->title('Artikel dikembalikan ke penulis')->warning()->send();
            });
    }

    /** Admin: take a live article offline (back to draft). */
    public static function unpublish(): Action
    {
        return Action::make('unpublish')
            ->label('Tarik dari Situs')
            ->icon('heroicon-o-eye-slash')
            ->color('gray')
            ->requiresConfirmation()
            ->visible(fn (Article $record) => Gate::allows('publish', $record) && $record->status === Article::STATUS_PUBLISHED)
            ->action(fn (Article $record) => $record->update(['status' => Article::STATUS_DRAFT]));
    }

    /** Admin: pin / unpin a published article. */
    public static function togglePin(): Action
    {
        return Action::make('togglePin')
            ->label(fn (Article $record) => $record->is_pinned ? 'Lepas Pin' : 'Sematkan')
            ->icon(fn (Article $record) => $record->is_pinned ? 'heroicon-o-x-mark' : 'heroicon-o-bookmark')
            ->color('warning')
            ->visible(fn (Article $record) => Gate::allows('publish', $record) && $record->status === Article::STATUS_PUBLISHED)
            ->action(fn (Article $record) => $record->update(['is_pinned' => ! $record->is_pinned]));
    }
}
