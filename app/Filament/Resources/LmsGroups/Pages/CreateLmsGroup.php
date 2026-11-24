<?php

namespace App\Filament\Resources\LmsGroups\Pages;

use App\Filament\Resources\LmsGroups\LmsGroupResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLmsGroup extends CreateRecord
{
    protected static string $resource = LmsGroupResource::class;

    /** Go straight to the edit page, where products can be added to the new column. */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}
