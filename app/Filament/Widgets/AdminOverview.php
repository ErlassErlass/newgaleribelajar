<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ArticleComments\ArticleCommentResource;
use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Contacts\ContactResource;
use App\Filament\Resources\Leads\LeadResource;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Contact;
use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/** Dashboard summary: to-do items for admins, own article status for writers. */
class AdminOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -1;

    protected function getStats(): array
    {
        $user = auth()->user();

        if (! $user->isAdmin()) {
            $mine = Article::where('author_id', $user->id);

            return [
                Stat::make('Draf saya', (clone $mine)->where('status', Article::STATUS_DRAFT)->count())
                    ->url(ArticleResource::getUrl('index')),
                Stat::make('Menunggu persetujuan', (clone $mine)->where('status', Article::STATUS_REVIEW)->count())->color('info'),
                Stat::make('Perlu revisi', (clone $mine)->where('status', Article::STATUS_REJECTED)->count())->color('warning'),
                Stat::make('Sudah terbit', (clone $mine)->where('status', Article::STATUS_PUBLISHED)->count())->color('success'),
            ];
        }

        return [
            Stat::make('Artikel menunggu persetujuan', Article::where('status', Article::STATUS_REVIEW)->count())
                ->description('Perlu disetujui atau dikembalikan')->color('info')
                ->url(ArticleResource::getUrl('index')),
            Stat::make('Komentar perlu ditinjau', ArticleComment::where('is_approved', false)->count())
                ->description(ArticleComment::where('is_flagged', true)->where('is_approved', false)->count().' ditandai tidak pantas')
                ->color('danger')->url(ArticleCommentResource::getUrl('index')),
            Stat::make('Lead konsultasi (7 hari)', Lead::where('created_at', '>=', now()->subDays(7))->count())
                ->color('warning')->url(LeadResource::getUrl('index')),
            Stat::make('Kontak bersedia promosi', Contact::where('marketing_consent', true)->count())
                ->description(Contact::count().' kontak total')->color('success')
                ->url(ContactResource::getUrl('index')),
        ];
    }
}
