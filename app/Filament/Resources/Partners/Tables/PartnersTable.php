<?php

namespace App\Filament\Resources\Partners\Tables;

use App\Filament\Resources\Partners\Schemas\PartnerForm;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PartnersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                ImageColumn::make('logo_url')->label('Logo')
                    ->disk('uploads')->square()->imageSize(40),
                TextColumn::make('name')->label('Nama sekolah')
                    ->searchable()->sortable()->wrap()
                    ->description(fn ($record) => collect([$record->city, $record->province])->filter()->implode(', ')),
                TextColumn::make('level')->label('Jenjang')->badge()->sortable(),
                TextColumn::make('type')->label('Jenis')
                    ->formatStateUsing(fn (?string $state) => PartnerForm::TYPES[$state] ?? $state)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total_deals')->label('Program')->numeric()->sortable(),
                ToggleColumn::make('is_featured')->label('Di beranda')->sortable(),
                TextColumn::make('sort_order')->label('Urutan')->numeric()->sortable(),
                TextColumn::make('kodlan')->label('Kode CRM')->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('Diubah')->since()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('level')->label('Jenjang')->options(PartnerForm::LEVELS),
                TernaryFilter::make('is_featured')->label('Tampil di beranda'),
                TernaryFilter::make('has_logo')->label('Logo')
                    ->trueLabel('Sudah ada logo')->falseLabel('Belum ada logo')
                    ->queries(
                        true: fn (Builder $q) => $q->whereNotNull('logo_url')->where('logo_url', '!=', ''),
                        false: fn (Builder $q) => $q->where(fn ($w) => $w->whereNull('logo_url')->orWhere('logo_url', '')),
                    ),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('feature')->label('Tampilkan di beranda')->icon('heroicon-o-eye')
                        ->action(fn (Collection $records) => $records->each->update(['is_featured' => true]))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('unfeature')->label('Sembunyikan dari beranda')->icon('heroicon-o-eye-slash')
                        ->action(fn (Collection $records) => $records->each->update(['is_featured' => false]))
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
