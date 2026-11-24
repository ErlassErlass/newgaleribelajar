<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['author_id'] = auth()->id();

        // Writers always start with a draft; only admins may publish directly
        if (! auth()->user()->isAdmin()) {
            $data['status'] = Article::STATUS_DRAFT;
            unset($data['published_at'], $data['is_pinned'], $data['is_published']);
        }
        $data['status'] ??= Article::STATUS_DRAFT;

        return $data;
    }
}
