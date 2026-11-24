<?php

namespace App\Filament\Resources\LmsGroups\Pages;

use App\Filament\Resources\LmsGroups\LmsGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLmsGroup extends EditRecord
{
    protected static string $resource = LmsGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
