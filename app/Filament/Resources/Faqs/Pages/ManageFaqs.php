<?php

namespace App\Filament\Resources\Faqs\Pages;

use App\Filament\Resources\Faqs\FaqResource;
use App\Models\Faq;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ManageFaqs extends ManageRecords
{
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->label('Tambah Pertanyaan')];
    }

    public function getTabs(): array
    {
        return [
            Faq::SCOPE_CATALOG => Tab::make('Pertanyaan Seputar Katalog')
                ->badge(Faq::where('scope', Faq::SCOPE_CATALOG)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('scope', Faq::SCOPE_CATALOG)),
            Faq::SCOPE_PRODUCT => Tab::make('Template Pertanyaan Umum Produk')
                ->badge(Faq::where('scope', Faq::SCOPE_PRODUCT)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('scope', Faq::SCOPE_PRODUCT)),
        ];
    }
}
