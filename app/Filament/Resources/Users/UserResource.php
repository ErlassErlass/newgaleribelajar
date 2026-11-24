<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\ManageUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use UnitEnum;

/** Super Admin only (see UserPolicy). */
class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Pengguna';

    protected static ?string $pluralModelLabel = 'Pengguna & Role';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|UnitEnum|null $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama')->required()->maxLength(100),
            TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
            Select::make('role')->label('Role')->options(User::ROLES)->required()->default(User::ROLE_WRITER)
                ->helperText('Super Admin: semua akses · Admin: kelola konten & setujui artikel · Content Writer: hanya menulis artikel.')
                // A super admin cannot demote themselves (would lock the last admin out)
                ->disabled(fn (?User $record) => $record && $record->id === auth()->id()),
            Toggle::make('is_active')->label('Akun aktif')->default(true)
                ->disabled(fn (?User $record) => $record && $record->id === auth()->id()),
            TextInput::make('password')->label('Kata sandi')->password()->revealable()
                ->rule(Password::min(10)->letters()->numbers())
                ->required(fn (string $operation) => $operation === 'create')
                ->dehydrated(fn (?string $state) => filled($state))
                ->dehydrateStateUsing(fn (string $state) => Hash::make($state))
                ->helperText('Min. 10 karakter, huruf dan angka. Kosongkan saat edit bila tidak diganti.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role')->label('Role')->badge()
                    ->formatStateUsing(fn ($state) => User::ROLES[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        User::ROLE_SUPER_ADMIN => 'danger',
                        User::ROLE_ADMIN => 'warning',
                        default => 'info',
                    }),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
                TextColumn::make('articles_count')->label('Artikel')->counts('articles'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime('d M Y')->toggleable(),
            ])
            ->filters([SelectFilter::make('role')->options(User::ROLES)])
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => ManageUsers::route('/')];
    }
}
