<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * Homepage content: hero texts & slider photos, and each section's heading / visibility.
 * Admin and Super Admin only. Saved to settings["homepage"], merged over config/homepage.php.
 */
class HomepageSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static string|UnitEnum|null $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 3;

    protected static ?string $title = 'Pengaturan Beranda';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function mount(): void
    {
        $this->form->fill(config('homepage'));
    }

    public function form(Schema $schema): Schema
    {
        $sections = [];
        foreach (config('homepage.sections') as $key => $sec) {
            $fields = [
                Toggle::make("sections.$key.visible")->label("Tampilkan bagian ini di beranda")->columnSpanFull(),
            ];
            if (array_key_exists('badge', $sec)) {
                $fields[] = TextInput::make("sections.$key.badge")->label('Label kecil')->maxLength(80);
            }
            $fields[] = TextInput::make("sections.$key.title")->label('Judul')->required()->maxLength(160)
                ->helperText($key === 'partners' ? 'Gunakan {jumlah} untuk jumlah sekolah mitra.' : null)
                ->columnSpan(array_key_exists('badge', $sec) ? 1 : 2);
            if (array_key_exists('subtitle', $sec)) {
                $fields[] = Textarea::make("sections.$key.subtitle")->label('Deskripsi')->rows(3)->maxLength(600)->columnSpanFull();
            }

            $sections[] = Section::make($sec['label'])
                ->description('#'.$key)
                ->columns(2)
                ->collapsible()
                ->collapsed()
                ->schema($fields);
        }

        return $schema
            ->statePath('data')
            ->components([
                Tabs::make()->tabs([
                    Tab::make('Hero (bagian paling atas)')->icon('heroicon-o-sparkles')->columns(2)->schema([
                        TextInput::make('hero.badge')->label('Label kecil di atas judul')->maxLength(100)->columnSpanFull(),
                        TextInput::make('hero.title')->label('Judul')->required()->maxLength(120),
                        TextInput::make('hero.title_highlight')->label('Kata yang diwarnai (setelah judul)')->maxLength(40),
                        Textarea::make('hero.description')->label('Deskripsi')->rows(3)->maxLength(400)->columnSpanFull(),
                        TextInput::make('hero.cta_primary')->label('Tombol 1 (ke Produk)')->required()->maxLength(40),
                        TextInput::make('hero.cta_secondary')->label('Tombol 2 (ke Konsultasi)')->required()->maxLength(40),
                        Repeater::make('hero.slides')->label('Foto slider')
                            ->schema([
                                FileUpload::make('image')->label('Foto')->image()->imageEditor()->required()->maxSize(3072)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->disk('uploads')->directory('uploads/home'),
                                TextInput::make('tag')->label('Label')->maxLength(40),
                                TextInput::make('caption')->label('Keterangan')->maxLength(160),
                            ])
                            ->columns(3)
                            ->minItems(1)->maxItems(6)
                            ->reorderable()->collapsible()
                            ->itemLabel(fn (array $state) => $state['tag'] ?? null)
                            ->columnSpanFull(),
                    ]),
                    Tab::make('Bagian Beranda')->icon('heroicon-o-squares-2x2')->schema($sections),
                ]),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make([
                        Action::make('save')->label('Simpan Beranda')->submit('save')->keyBindings(['mod+s']),
                    ])->key('form-actions'),
                ]),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')->label('Lihat Beranda')->color('gray')->icon('heroicon-o-arrow-top-right-on-square')
                ->url(route('home'), true),
            Action::make('reset')->label('Kembalikan ke Bawaan')->color('danger')->icon('heroicon-o-arrow-uturn-left')
                ->requiresConfirmation()
                ->modalDescription('Semua teks, foto slider, dan pengaturan tampil/sembunyi di beranda dikembalikan ke bawaan.')
                ->action(function () {
                    Setting::where('key', 'homepage')->first()?->delete();
                    config(['homepage' => require config_path('homepage.php')]);
                    $this->form->fill(config('homepage'));
                    Notification::make()->title('Beranda dikembalikan ke bawaan')->success()->send();
                }),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();
        $state['hero']['slides'] = array_values($state['hero']['slides'] ?? []);
        // Labels are form captions, not content
        foreach ($state['sections'] ?? [] as $key => $sec) {
            unset($state['sections'][$key]['label']);
        }

        Setting::put('homepage', $state);

        Notification::make()->title('Beranda disimpan')->body('Perubahan langsung tampil di situs.')->success()->send();
    }
}
