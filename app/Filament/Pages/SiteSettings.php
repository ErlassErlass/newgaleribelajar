<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
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
 * Site-wide settings (Shopee link, contacts, social media, videos, comment moderation).
 * Admin and Super Admin only. Values are stored in the `settings` table and override config/erlass.php.
 */
class SiteSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'Pengaturan Situs';

    /** Setting keys (config paths under "erlass.") managed on this page. */
    private const KEYS = [
        'shopee', 'lms', 'whatsapp', 'phone_display', 'email', 'office_hours', 'address_hq', 'address_ops',
        'social.instagram', 'social.tiktok', 'social.youtube', 'social.facebook', 'social.facebook_group',
        'youtube_channel_id', 'videos', 'comments_auto_approve', 'blocked_words_extra',
    ];

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function mount(): void
    {
        $state = [];
        foreach (self::KEYS as $key) {
            data_set($state, $key, config('erlass.'.$key));
        }
        $this->form->fill($state);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Tabs::make()->tabs([
                    Tab::make('Toko & Platform')->icon('heroicon-o-shopping-bag')->schema([
                        TextInput::make('shopee')->label('Link toko Shopee')->url()->required()
                            ->helperText('Dipakai di tombol "Belanja di Shopee" untuk produk tanpa link khusus.'),
                        TextInput::make('lms')->label('Link LMS Erlass Academy')->url()->required(),
                    ]),
                    Tab::make('Kontak')->icon('heroicon-o-phone')->columns(2)->schema([
                        TextInput::make('whatsapp')->label('Nomor WhatsApp (format 62...)')->required()->regex('/^62\d{8,13}$/'),
                        TextInput::make('phone_display')->label('Nomor telepon (tampilan)')->required(),
                        TextInput::make('email')->label('Email')->email()->required(),
                        Textarea::make('office_hours')->label('Jam layanan')->rows(2)
                            ->helperText('Satu jadwal per baris (tekan Enter), mis. "Sabtu: 08:00 – 13:00 WIB".'),
                        Textarea::make('address_hq')->label('Alamat kantor pusat')->rows(2),
                        Textarea::make('address_ops')->label('Alamat operasional')->rows(2),
                    ]),
                    Tab::make('Media Sosial')->icon('heroicon-o-share')->columns(2)->schema([
                        TextInput::make('social.instagram')->label('Instagram')->url(),
                        TextInput::make('social.tiktok')->label('TikTok')->url(),
                        TextInput::make('social.youtube')->label('YouTube')->url(),
                        TextInput::make('social.facebook')->label('Facebook')->url(),
                        TextInput::make('social.facebook_group')->label('Grup Facebook')->url(),
                    ]),
                    Tab::make('Video')->icon('heroicon-o-play-circle')->schema([
                        TextInput::make('youtube_channel_id')->label('YouTube Channel ID')
                            ->helperText('Untuk mengambil jumlah views otomatis. Diawali "UC".'),
                        Repeater::make('videos')->label('Daftar video (urutan = urutan tampil)')
                            ->helperText('3 video pertama tampil di bagian "Why Erlass?" di beranda; semuanya tampil di halaman Galeri.')
                            ->schema([
                                TextInput::make('title')->label('Judul')->required(),
                                TextInput::make('youtube_id')->label('ID YouTube')->required()
                                    ->regex('/^[A-Za-z0-9_-]{11}$/')
                                    ->helperText('11 karakter setelah "v=" atau "youtu.be/".'),
                                TextInput::make('label')->label('Label kategori')->default('Video'),
                                Textarea::make('desc')->label('Deskripsi singkat')->rows(2),
                            ])
                            ->columns(2)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state) => $state['title'] ?? null),
                    ]),
                    Tab::make('Moderasi Komentar')->icon('heroicon-o-shield-check')->schema([
                        Toggle::make('comments_auto_approve')->label('Tampilkan komentar langsung tanpa persetujuan')
                            ->helperText('Komentar yang mengandung kata tidak pantas, tautan, atau huruf kapital semua tetap ditahan untuk ditinjau.'),
                        TagsInput::make('blocked_words_extra')->label('Kata terlarang tambahan')
                            ->helperText('Ditambahkan ke daftar bawaan. Ketik lalu tekan Enter.'),
                    ]),
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
                        Action::make('save')->label('Simpan Pengaturan')->submit('save')->keyBindings(['mod+s']),
                    ])->key('form-actions'),
                ]),
        ]);
    }

    public function save(): void
    {
        $state = $this->form->getState();

        // Repeater items come keyed by UUID; store a plain ordered list
        $state['videos'] = array_values($state['videos'] ?? []);
        $state['blocked_words_extra'] = array_values($state['blocked_words_extra'] ?? []);

        foreach (self::KEYS as $key) {
            Setting::put($key, data_get($state, $key));
        }

        Notification::make()->title('Pengaturan disimpan')->body('Perubahan langsung berlaku di situs.')->success()->send();
    }
}
