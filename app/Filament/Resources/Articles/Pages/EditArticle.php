<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleActions;
use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [...ArticleActions::all(), DeleteAction::make()];
    }

    /** Writers can never change workflow fields, even with a crafted request. */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! auth()->user()->isAdmin()) {
            unset($data['status'], $data['published_at'], $data['is_pinned'], $data['is_published']);
        }

        return $data;
    }
}
