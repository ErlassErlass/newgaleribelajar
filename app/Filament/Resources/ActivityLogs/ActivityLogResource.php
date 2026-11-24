<?php

namespace App\Filament\Resources\ActivityLogs;

use App\Filament\Resources\ActivityLogs\Pages\ListActivityLogs;
use App\Models\ActivityLog;
use App\Models\User;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

/** "Riwayat Perubahan": who changed what. Read-only, Super Admin only (ActivityLogPolicy). */
class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;

    protected static ?string $modelLabel = 'Riwayat';

    protected static ?string $pluralModelLabel = 'Riwayat Perubahan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static string|UnitEnum|null $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 9;

    private const EVENT_COLORS = [
        'created' => 'success', 'updated' => 'info', 'deleted' => 'danger',
        'login' => 'gray', 'logout' => 'gray', 'login_failed' => 'warning', 'export' => 'warning',
    ];

    /** Field names as shown in the change list. */
    public static function fieldLabel(string $field): string
    {
        static $labels = [
            'title' => 'Judul', 'name' => 'Nama', 'slug' => 'Slug URL', 'status' => 'Status', 'category' => 'Kategori',
            'category_id' => 'Kategori', 'is_published' => 'Terbit', 'is_pinned' => 'Disematkan', 'published_at' => 'Tanggal terbit',
            'body' => 'Isi', 'excerpt' => 'Ringkasan', 'summary' => 'Ringkasan', 'description' => 'Deskripsi',
            'cover_image' => 'Gambar', 'meta_title' => 'Meta title', 'meta_description' => 'Meta description',
            'shopee_url' => 'Link Shopee', 'on_shopee' => 'Tersedia di Shopee', 'on_lms' => 'Produk LMS',
            'lms_group' => 'Kolom LMS', 'lms_order' => 'Urutan di kolom LMS', 'lms_url' => 'Link LMS', 'is_free' => 'Gratis',
            'is_featured' => 'Unggulan', 'deal_count' => 'Jumlah sekolah', 'sort_order' => 'Urutan',
            'role' => 'Role', 'is_active' => 'Aktif', 'email' => 'Email', 'password' => 'Kata sandi',
            'is_approved' => 'Komentar tampil', 'is_flagged' => 'Ditandai', 'marketing_consent' => 'Izin promosi',
            'review_note' => 'Catatan revisi', 'author_id' => 'Penulis', 'reviewed_by' => 'Disetujui oleh',
            'question' => 'Pertanyaan', 'answer' => 'Jawaban', 'faq_mode' => 'Sumber FAQ', 'faqs' => 'FAQ khusus',
            'value' => 'Isi', 'color' => 'Warna',
        ];

        return $labels[$field] ?? $field;
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('created_at')->label('Waktu')->dateTime('d M Y, H:i:s'),
            TextEntry::make('user_name')->label('Oleh')
                ->formatStateUsing(fn ($state, ActivityLog $record) => ($state ?? 'Sistem / tidak dikenal').($record->user_role ? ' ('.(User::ROLES[$record->user_role] ?? $record->user_role).')' : '')),
            TextEntry::make('event')->label('Aksi')->badge()
                ->formatStateUsing(fn ($state) => ActivityLog::EVENTS[$state] ?? $state)
                ->color(fn ($state) => self::EVENT_COLORS[$state] ?? 'gray'),
            TextEntry::make('subject')->label('Data')
                ->state(fn (ActivityLog $record) => trim(($record->subject_type ? $record->subject_name.': ' : '').($record->subject_label ?? ''), ': ') ?: '-'),
            TextEntry::make('description')->label('Keterangan')->placeholder('-')->columnSpanFull(),
            TextEntry::make('ip_address')->label('Alamat IP')->placeholder('-'),
            KeyValueEntry::make('changes')->label('Perubahan (sebelum → sesudah)')
                ->keyLabel('Kolom')->valueLabel('Sebelum → Sesudah')
                ->state(fn (ActivityLog $record) => collect($record->changes ?? [])->mapWithKeys(fn ($c, $field) => [
                    self::fieldLabel(explode('.', (string) $field)[0]).(str_contains((string) $field, '.') ? ' › '.substr((string) $field, strpos((string) $field, '.') + 1) : '')
                        => self::show($c['old'] ?? null).'  →  '.self::show($c['new'] ?? null),
                ])->all())
                ->visible(fn (ActivityLog $record) => ! empty($record->changes))
                ->columnSpanFull(),
        ])->columns(2);
    }

    private static function show(mixed $value): string
    {
        return match (true) {
            $value === null || $value === '' => '(kosong)',
            is_bool($value) => $value ? 'Ya' : 'Tidak',
            is_array($value) => json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            default => (string) $value,
        };
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')->label('Waktu')->dateTime('d M Y H:i')->sortable()
                    ->description(fn (ActivityLog $record) => $record->created_at?->diffForHumans()),
                TextColumn::make('user_name')->label('Oleh')->searchable()->placeholder('Sistem')
                    ->description(fn (ActivityLog $record) => $record->user_role ? (User::ROLES[$record->user_role] ?? $record->user_role) : null),
                TextColumn::make('event')->label('Aksi')->badge()
                    ->formatStateUsing(fn ($state) => ActivityLog::EVENTS[$state] ?? $state)
                    ->color(fn ($state) => self::EVENT_COLORS[$state] ?? 'gray'),
                TextColumn::make('subject_label')->label('Data')->searchable()->wrap()->placeholder('-')
                    ->description(fn (ActivityLog $record) => $record->subject_type ? $record->subject_name : $record->description),
                TextColumn::make('changes')->label('Kolom yang diubah')->wrap()
                    ->state(fn (ActivityLog $record) => $record->event === 'updated'
                        ? collect(array_keys($record->changes ?? []))->map(fn ($f) => self::fieldLabel(explode('.', (string) $f)[0]))->unique()->implode(', ')
                        : null)
                    ->placeholder('-'),
            ])
            ->filters([
                SelectFilter::make('event')->label('Aksi')->options(ActivityLog::EVENTS),
                SelectFilter::make('subject_type')->label('Jenis data')->options(ActivityLog::SUBJECTS),
                SelectFilter::make('user_id')->label('Pengguna')
                    ->options(fn () => User::orderBy('name')->pluck('name', 'id')->all()),
                Filter::make('date')->label('Rentang tanggal')
                    ->schema([
                        DatePicker::make('from')->label('Dari'),
                        DatePicker::make('until')->label('Sampai'),
                    ])
                    ->query(fn (Builder $query, array $data) => $query
                        ->when($data['from'] ?? null, fn ($q, $d) => $q->whereDate('created_at', '>=', $d))
                        ->when($data['until'] ?? null, fn ($q, $d) => $q->whereDate('created_at', '<=', $d))),
            ])
            ->recordActions([ViewAction::make()->label('Detail')])
            ->toolbarActions([]);
    }

    public static function getPages(): array
    {
        return ['index' => ListActivityLogs::route('/')];
    }
}
