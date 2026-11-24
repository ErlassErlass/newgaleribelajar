<?php

namespace App\Filament\Resources\ActivityLogs\Pages;

use App\Filament\Resources\ActivityLogs\ActivityLogResource;
use App\Models\ActivityLog;
use Filament\Resources\Pages\ListRecords;

class ListActivityLogs extends ListRecords
{
    protected static string $resource = ActivityLogResource::class;

    public function getSubheading(): ?string
    {
        return 'Catatan siapa menambah, mengubah, atau menghapus data penting, serta login dan ekspor data. Disimpan '.ActivityLog::RETENTION_DAYS.' hari.';
    }
}
