<?php

namespace App\Filament\Resources\Contacts;

use App\Filament\Resources\Contacts\Pages\ManageContacts;
use App\Models\Contact;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;
use UnitEnum;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $modelLabel = 'Kontak';

    protected static ?string $pluralModelLabel = 'Kontak Promosi';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static string|UnitEnum|null $navigationGroup = 'Pemasaran';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'email';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
            TextInput::make('name')->label('Nama'),
            TextInput::make('phone')->label('Telepon / WA'),
            Select::make('sources')->label('Sumber')->multiple()->options(Contact::SOURCES),
            Toggle::make('marketing_consent')->label('Bersedia menerima promosi')
                ->helperText('Matikan bila kontak meminta berhenti menerima email.'),
            Textarea::make('notes')->label('Catatan tim promosi')->rows(3)->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        // Note: Filament injects closure parameters by name, so they must be called $query / $data / $records
        return $table
            ->defaultSort('last_seen_at', 'desc')
            ->columns([
                TextColumn::make('email')->searchable()->copyable(),
                TextColumn::make('name')->label('Nama')->searchable()->placeholder('-'),
                TextColumn::make('phone')->label('Telepon')->placeholder('-')->toggleable(),
                TextColumn::make('sources')->label('Sumber')->badge()
                    ->formatStateUsing(fn ($state) => Contact::SOURCES[$state] ?? $state),
                IconColumn::make('marketing_consent')->label('Izin promosi')->boolean(),
                TextColumn::make('comment_count')->label('Komentar')->numeric()->sortable(),
                TextColumn::make('last_seen_at')->label('Terakhir aktif')->since()->sortable(),
            ])
            ->filters([
                TernaryFilter::make('marketing_consent')->label('Izin promosi'),
                SelectFilter::make('source')->label('Sumber')->options(Contact::SOURCES)
                    ->query(fn (Builder $query, array $data) => filled($data['value'] ?? null)
                        ? $query->whereJsonContains('sources', $data['value'])
                        : $query),
            ])
            ->headerActions([
                Action::make('exportConsented')
                    ->label('Ekspor CSV (yang memberi izin)')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(fn () => self::csv(Contact::where('marketing_consent', true)->orderBy('email')->get(), 'kontak-promosi')),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('exportSelected')->label('Ekspor CSV terpilih')->icon('heroicon-o-arrow-down-tray')
                        ->action(fn (Collection $records) => self::csv($records, 'kontak-terpilih')),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    /** CSV that opens cleanly in Excel / Google Sheets (UTF-8 BOM, formula injection guarded). */
    public static function csv(iterable $contacts, string $name): StreamedResponse
    {
        $safe = fn ($v) => preg_match('/^[=+\-@]/', (string) $v) ? "'".$v : (string) $v;

        // Exporting personal data is logged: who downloaded how many contacts
        \App\Models\ActivityLog::record('export', null, [], 'Ekspor CSV '.$name.': '.collect($contacts)->count().' kontak', label: 'Kontak Promosi');

        return response()->streamDownload(function () use ($contacts, $safe) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['Email', 'Nama', 'Telepon', 'Sumber', 'Izin Promosi', 'Jumlah Komentar', 'Pertama Terdata', 'Terakhir Aktif'], escape: '');
            foreach ($contacts as $c) {
                fputcsv($out, array_map($safe, [
                    $c->email,
                    $c->name,
                    $c->phone,
                    implode(', ', array_map(fn ($s) => Contact::SOURCES[$s] ?? $s, $c->sources ?? [])),
                    $c->marketing_consent ? 'Ya' : 'Tidak',
                    $c->comment_count,
                    $c->first_seen_at?->format('Y-m-d H:i'),
                    $c->last_seen_at?->format('Y-m-d H:i'),
                ]), escape: '');
            }
            fclose($out);
        }, $name.'-'.now()->format('Ymd-His').'.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageContacts::route('/'),
        ];
    }
}
