<?php

namespace App\Filament\Resources\LmsGroups\Pages;

use App\Filament\Resources\LmsGroups\LmsGroupResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLmsGroups extends ListRecords
{
    protected static string $resource = LmsGroupResource::class;

    protected ?string $subheading = 'Kolom di bagian "Produk Digital di LMS Erlass Academy" pada beranda. Seret baris untuk mengubah urutan kolom.';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')->label('Lihat di Beranda')->color('gray')->icon('heroicon-o-arrow-top-right-on-square')
                ->url(route('home').'#produk', true),
            CreateAction::make()->label('Tambah Kolom'),
        ];
    }
}
