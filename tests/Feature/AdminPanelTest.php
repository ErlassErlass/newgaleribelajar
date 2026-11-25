<?php

namespace Tests\Feature;

use App\Filament\Pages\HomepageSettings;
use App\Filament\Pages\SiteSettings;
use App\Filament\Resources;
use App\Filament\Resources\LmsGroups\RelationManagers\ProductsRelationManager;
use App\Models\ActivityLog;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleComment;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Lead;
use App\Models\LmsGroup;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Clicks through the admin panel: every page, every form save and the custom actions,
 * for each role. Runs on the in-memory SQLite test database (phpunit.xml), never on MySQL.
 */
class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    private User $super;
    private User $admin;
    private User $writer;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('uploads'); // uploads must not land in the real public/ folder
        // The fake disk starts empty; put the photos that existing records point to on it
        foreach (glob(public_path('img/gallery/*.webp')) as $file) {
            Storage::disk('uploads')->put('img/gallery/'.basename($file), file_get_contents($file));
        }
        Filament::setCurrentPanel(Filament::getPanel('admin'));

        $this->super = User::where('email', 'admin@erlass.co.id')->firstOrFail();
        $this->admin = $this->makeUser('admin@test.local', User::ROLE_ADMIN);
        $this->writer = $this->makeUser('writer@test.local', User::ROLE_WRITER);
    }

    private function makeUser(string $email, string $role): User
    {
        $u = new User(['name' => ucfirst($role).' Test', 'email' => $email, 'password' => 'Rahasia12345']);
        $u->forceFill(['role' => $role, 'is_active' => true])->save();

        return $u;
    }

    // ------------------------------------------------------------------ pages

    public function test_seeded_admin_is_super_admin(): void
    {
        $this->assertSame(User::ROLE_SUPER_ADMIN, $this->super->role);
    }

    public function test_every_admin_page_renders_for_super_admin(): void
    {
        $this->actingAs($this->super);
        $article = Article::first();
        $product = Product::where('sku', 'MLK01')->first();

        $pages = [
            [Resources\Articles\Pages\ListArticles::class, []],
            [Resources\Articles\Pages\CreateArticle::class, []],
            [Resources\Articles\Pages\EditArticle::class, ['record' => $article->getKey()]],
            [Resources\ArticleCategories\Pages\ManageArticleCategories::class, []],
            [Resources\ArticleComments\Pages\ManageArticleComments::class, []],
            [Resources\Products\Pages\ListProducts::class, []],
            [Resources\Products\Pages\CreateProduct::class, []],
            [Resources\Products\Pages\EditProduct::class, ['record' => $product->getKey()]],
            [Resources\Categories\Pages\ListCategories::class, []],
            [Resources\Categories\Pages\CreateCategory::class, []],
            [Resources\Categories\Pages\EditCategory::class, ['record' => \App\Models\Category::first()->getKey()]],
            [Resources\Partners\Pages\ListPartners::class, []],
            [Resources\Partners\Pages\CreatePartner::class, []],
            [Resources\Partners\Pages\EditPartner::class, ['record' => \App\Models\Partner::first()->getKey()]],
            [Resources\Faqs\Pages\ManageFaqs::class, []],
            [Resources\LmsGroups\Pages\ListLmsGroups::class, []],
            [Resources\LmsGroups\Pages\CreateLmsGroup::class, []],
            [Resources\LmsGroups\Pages\EditLmsGroup::class, ['record' => LmsGroup::first()->getKey()]],
            [Resources\Galleries\Pages\ListGalleries::class, []],
            [Resources\Galleries\Pages\CreateGallery::class, []],
            [Resources\Galleries\Pages\EditGallery::class, ['record' => Gallery::first()->getKey()]],
            [Resources\Programs\Pages\ListPrograms::class, []],
            [Resources\Programs\Pages\CreateProgram::class, []],
            [Resources\Announcements\Pages\ListAnnouncements::class, []],
            [Resources\Announcements\Pages\CreateAnnouncement::class, []],
            [Resources\Leads\Pages\ListLeads::class, []],
            [Resources\Leads\Pages\CreateLead::class, []],
            [Resources\Contacts\Pages\ManageContacts::class, []],
            [Resources\Subscribers\Pages\ManageSubscribers::class, []],
            [Resources\Users\Pages\ManageUsers::class, []],
            [Resources\ActivityLogs\Pages\ListActivityLogs::class, []],
            [SiteSettings::class, []],
            [HomepageSettings::class, []],
        ];

        foreach ($pages as [$class, $params]) {
            Livewire::test($class, $params)->assertOk();
        }
        $this->get('/admin')->assertOk();
    }

    public function test_role_restrictions(): void
    {
        $this->actingAs($this->writer);
        $this->get('/admin/articles')->assertOk();
        foreach (['products', 'article-comments', 'contacts', 'site-settings', 'homepage-settings', 'users', 'activity-logs', 'lms-groups', 'faqs', 'article-categories'] as $path) {
            $this->get('/admin/'.$path)->assertForbidden();
        }

        // New session per account (Filament's AuthenticateSession logs out on an account switch)
        $this->flushSession();
        $this->actingAs($this->admin);
        foreach (['products', 'article-comments', 'contacts', 'site-settings', 'homepage-settings', 'lms-groups', 'faqs', 'article-categories'] as $path) {
            $this->get('/admin/'.$path)->assertOk();
        }
        $this->get('/admin/users')->assertForbidden();
        $this->get('/admin/activity-logs')->assertForbidden();

        $inactive = $this->makeUser('off@test.local', User::ROLE_ADMIN);
        $inactive->forceFill(['is_active' => false])->save();
        $this->flushSession();
        $this->actingAs($inactive)->get('/admin')->assertForbidden();
    }

    // ------------------------------------------------------------------ edit forms save cleanly

    public function test_existing_records_save_without_errors(): void
    {
        $this->actingAs($this->super);
        $records = [
            Resources\Products\Pages\EditProduct::class => Product::where('sku', 'MLK01')->first(),
            Resources\Articles\Pages\EditArticle::class => Article::first(),
            Resources\Galleries\Pages\EditGallery::class => Gallery::first(),
            Resources\Categories\Pages\EditCategory::class => \App\Models\Category::first(),
            Resources\Partners\Pages\EditPartner::class => \App\Models\Partner::first(),
            Resources\LmsGroups\Pages\EditLmsGroup::class => LmsGroup::first(),
        ];
        if ($program = \App\Models\Program::first()) {
            $records[Resources\Programs\Pages\EditProgram::class] = $program;
        }
        if ($ann = \App\Models\Announcement::first()) {
            $records[Resources\Announcements\Pages\EditAnnouncement::class] = $ann;
        }

        foreach ($records as $class => $record) {
            Livewire::test($class, ['record' => $record->getKey()])
                ->call('save')
                ->assertHasNoFormErrors();
        }
    }

    public function test_create_forms(): void
    {
        $this->actingAs($this->super);

        Livewire::test(Resources\Products\Pages\CreateProduct::class)
            ->fillForm([
                'name' => 'Produk Uji', 'sku' => 'UJI-01', 'slug' => 'produk-uji', 'product_type' => 'Fisik',
                'status' => 'published', 'education_levels' => ['SD'], 'features' => ['Poin A'],
                'faq_mode' => 'both', 'faqs' => [['question' => 'Tanya {produk}?', 'answer' => 'Jawab.']],
            ])
            ->call('create')
            ->assertHasNoFormErrors();
        $this->assertDatabaseHas('products', ['sku' => 'UJI-01']);

        Livewire::test(Resources\Galleries\Pages\CreateGallery::class)
            ->fillForm([
                'image_path' => UploadedFile::fake()->image('foto.jpg', 800, 600),
                'title' => 'Foto Uji', 'category' => 'guru', 'subcategory' => 'tot', 'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();
        $this->assertDatabaseHas('galleries', ['title' => 'Foto Uji', 'subcategory' => 'tot']);

        Livewire::test(Resources\LmsGroups\Pages\CreateLmsGroup::class)
            ->fillForm(['title' => 'Kolom Baru', 'slug' => 'kolom-baru', 'color' => '#7c3aed', 'is_active' => true])
            ->call('create')
            ->assertHasNoFormErrors();
        $this->assertDatabaseHas('lms_groups', ['slug' => 'kolom-baru']);

        Livewire::test(Resources\ArticleCategories\Pages\ManageArticleCategories::class)
            ->callAction('create', data: ['name' => 'Webinar', 'slug' => 'webinar', 'is_active' => true])
            ->assertHasNoActionErrors();
        $this->assertDatabaseHas('article_categories', ['slug' => 'webinar']);

        Livewire::test(Resources\Faqs\Pages\ManageFaqs::class)
            ->callAction('create', data: ['scope' => 'catalog', 'question' => 'Q uji?', 'answer' => 'A uji.', 'is_active' => true])
            ->assertHasNoActionErrors();
        $this->assertDatabaseHas('faqs', ['question' => 'Q uji?']);

        Livewire::test(Resources\Users\Pages\ManageUsers::class)
            ->callAction('create', data: ['name' => 'Penulis Baru', 'email' => 'baru@test.local', 'role' => 'writer', 'is_active' => true, 'password' => 'Rahasia12345'])
            ->assertHasNoActionErrors();
        $this->assertDatabaseHas('users', ['email' => 'baru@test.local', 'role' => 'writer']);

        Livewire::test(Resources\Contacts\Pages\ManageContacts::class)
            ->callAction('create', data: ['email' => 'kontak@test.local', 'marketing_consent' => true])
            ->assertHasNoActionErrors();
        $this->assertDatabaseHas('contacts', ['email' => 'kontak@test.local']);
    }

    // ------------------------------------------------------------------ LMS columns

    public function test_lms_column_add_remove_and_reorder_products(): void
    {
        $this->actingAs($this->admin);
        $group = LmsGroup::where('slug', 'course')->first();
        $msj = Product::where('sku', 'MSJ01')->first();
        $py = Product::where('sku', 'LMS-PY')->first();

        $rm = fn () => Livewire::test(ProductsRelationManager::class, [
            'ownerRecord' => $group,
            'pageClass' => Resources\LmsGroups\Pages\EditLmsGroup::class,
        ]);

        // "Tambah produk ke kolom"
        $rm()->assertOk()
            ->callTableAction('associate', data: ['recordId' => [$msj->id]])
            ->assertHasNoTableActionErrors();
        $msj->refresh();
        $this->assertSame('course', $msj->lms_group);
        $this->assertTrue($msj->on_lms);

        // "Keluarkan"
        $rm()->callTableAction('dissociate', $msj);
        $this->assertNull($msj->fresh()->lms_group);

        // drag to reorder
        $ids = $group->products()->pluck('id')->map(fn ($id) => (string) $id)->all();
        $reversed = array_reverse($ids);
        $rm()->call('reorderTable', $reversed);
        $this->assertSame((int) $reversed[0], $group->products()->first()->id);

        // label toggle in the table
        $rm()->call('updateTableColumnState', 'on_shopee', (string) $py->id, false);
        $this->assertFalse($py->fresh()->on_shopee);
    }

    // ------------------------------------------------------------------ article workflow

    public function test_article_review_workflow(): void
    {
        // Writer creates a draft: workflow fields are ignored even if sent
        $this->actingAs($this->writer);
        Livewire::test(Resources\Articles\Pages\CreateArticle::class)
            ->fillForm(['title' => 'Tulisan Writer', 'slug' => 'tulisan-writer', 'category' => 'artikel', 'body' => 'Isi.'])
            ->call('create')
            ->assertHasNoFormErrors();
        $article = Article::where('slug', 'tulisan-writer')->firstOrFail();
        $this->assertSame(Article::STATUS_DRAFT, $article->status);
        $this->assertSame($this->writer->id, $article->author_id);

        // Writer cannot see other people's articles
        $other = Article::where('author_id', '!=', $this->writer->id)->orWhereNull('author_id')->first();
        Livewire::test(Resources\Articles\Pages\ListArticles::class)
            ->assertCanSeeTableRecords([$article])
            ->assertCanNotSeeTableRecords([$other]);

        Livewire::test(Resources\Articles\Pages\EditArticle::class, ['record' => $article->getKey()])
            ->assertActionHidden('approve')
            ->callAction('submitForReview');
        $this->assertSame(Article::STATUS_REVIEW, $article->fresh()->status);

        // Admin sends it back, then approves and pins
        $this->actingAs($this->admin);
        Livewire::test(Resources\Articles\Pages\EditArticle::class, ['record' => $article->getKey()])
            ->callAction('reject', data: ['review_note' => 'Tambah foto.']);
        $this->assertSame(Article::STATUS_REJECTED, $article->fresh()->status);

        Livewire::test(Resources\Articles\Pages\EditArticle::class, ['record' => $article->getKey()])
            ->callAction('approve');
        $article->refresh();
        $this->assertSame(Article::STATUS_PUBLISHED, $article->status);
        $this->assertTrue($article->is_published);

        Livewire::test(Resources\Articles\Pages\ListArticles::class)
            ->callTableAction('togglePin', $article);
        $this->assertTrue($article->fresh()->is_pinned);

        $this->get('/artikel/tulisan-writer')->assertOk();
    }

    // ------------------------------------------------------------------ comments, contacts, settings, log

    public function test_comment_moderation_actions(): void
    {
        $this->actingAs($this->admin);
        $article = Article::published()->first();
        $c = ArticleComment::create(['article_id' => $article->id, 'name' => 'A', 'email' => 'a@test.local', 'body' => 'Halo', 'is_approved' => false]);

        $page = Livewire::test(Resources\ArticleComments\Pages\ManageArticleComments::class)->assertCanSeeTableRecords([$c]);
        $page->callTableAction('approve', $c);
        $this->assertTrue($c->fresh()->is_approved);
        $page->callTableAction('hide', $c);
        $this->assertFalse($c->fresh()->is_approved);
        $page->callTableBulkAction('approveSelected', [$c]);
        $this->assertTrue($c->fresh()->is_approved);
        $page->callTableAction('edit', $c, data: ['name' => 'A', 'body' => 'Halo diedit', 'is_approved' => true])->assertHasNoTableActionErrors();
        $this->assertSame('Halo diedit', $c->fresh()->body);
    }

    public function test_contact_export_downloads_csv(): void
    {
        $this->actingAs($this->admin);
        Contact::record('promo@test.local', 'newsletter', ['consent' => true]);

        Livewire::test(Resources\Contacts\Pages\ManageContacts::class)
            ->callTableAction('exportConsented')
            ->assertFileDownloaded();
        $this->assertDatabaseHas('activity_logs', ['event' => 'export']);
    }

    public function test_site_and_homepage_settings_save(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(SiteSettings::class)
            ->fillForm(['shopee' => 'https://shopee.co.id/erlass-uji', 'office_hours' => "Senin: 08:00\nSabtu: 09:00"])
            ->call('save')
            ->assertHasNoFormErrors();
        $this->assertSame('https://shopee.co.id/erlass-uji', Setting::find('shopee')->value);

        Livewire::test(HomepageSettings::class)
            ->fillForm(['hero.title' => 'Judul Baru', 'sections.solutions.visible' => false])
            ->call('save')
            ->assertHasNoFormErrors();
        $home = Setting::find('homepage')->value;
        $this->assertSame('Judul Baru', $home['hero']['title']);
        $this->assertFalse($home['sections']['solutions']['visible']);

        Livewire::test(HomepageSettings::class)->callAction('reset');
        $this->assertNull(Setting::find('homepage'));
    }

    public function test_activity_log_records_admin_changes_and_is_read_only(): void
    {
        $this->actingAs($this->admin);
        $p = Product::where('sku', 'MLK01')->first();
        Livewire::test(Resources\Products\Pages\EditProduct::class, ['record' => $p->getKey()])
            ->fillForm(['shopee_url' => 'https://shopee.co.id/mlk'])
            ->call('save')
            ->assertHasNoFormErrors();

        $log = ActivityLog::where('subject_type', Product::class)->where('subject_id', $p->id)->latest('id')->first();
        $this->assertNotNull($log);
        $this->assertSame($this->admin->id, $log->user_id);
        $this->assertArrayHasKey('shopee_url', $log->changes);

        $this->actingAs($this->super);
        Livewire::test(Resources\ActivityLogs\Pages\ListActivityLogs::class)
            ->assertCanSeeTableRecords([$log])
            ->mountTableAction('view', $log)
            ->assertHasNoTableActionErrors();
        $this->assertFalse($this->super->can('delete', $log));
    }

    public function test_guide_page_shows_each_role_its_own_guide(): void
    {
        $cases = [
            [$this->writer, 'Panduan Content Writer (role Anda)', ['Panduan Admin', 'Panduan Super Admin']],
            [$this->admin, 'Panduan Admin (role Anda)', ['Panduan Super Admin']],
            [$this->super, 'Panduan Super Admin (role Anda)', []],
        ];
        foreach ($cases as [$user, $own, $hidden]) {
            $this->flushSession();
            $this->app['auth']->forgetGuards(); // fresh login per role (AuthenticateSession checks the password hash)
            $res = $this->actingAs($user)->get('/admin/panduan')->assertOk()
                ->assertSee($own)
                ->assertSee('Berlaku untuk semua role')
                ->assertSee('Ringkasan hak akses')
                ->assertDontSee('href="PANDUAN', false); // links to repo files are flattened to plain text
            foreach ($hidden as $text) {
                $res->assertDontSee($text);
            }
        }
    }

    public function test_partner_logo_upload_shows_on_homepage_and_is_cleaned_up(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(Resources\Partners\Pages\CreatePartner::class)
            ->fillForm([
                'name' => 'SD Uji Logo', 'slug' => 'sd-uji-logo', 'city' => 'Bogor', 'level' => 'SD', 'type' => 'school',
                'logo_url' => UploadedFile::fake()->image('logo.png', 200, 200),
                'total_deals' => 3, 'is_featured' => true, 'sort_order' => -1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $partner = \App\Models\Partner::where('slug', 'sd-uji-logo')->firstOrFail();
        $this->assertStringStartsWith('uploads/partners/', $partner->logo_url);
        Storage::disk('uploads')->assertExists($partner->logo_url);

        // Shown on the homepage marquee as an image
        \App\Support\SiteCache::flush();
        $this->get('/')->assertOk()->assertSee($partner->logo_url, false)->assertSee('SD Uji Logo');

        // Admin list: filter by "has logo" and hide it from the homepage with the inline toggle
        Livewire::test(Resources\Partners\Pages\ListPartners::class)
            ->filterTable('has_logo', true)
            ->assertCanSeeTableRecords([$partner])
            ->call('updateTableColumnState', 'is_featured', (string) $partner->id, false);
        $this->assertFalse($partner->fresh()->is_featured);

        // Deleting the school removes its logo file
        $path = $partner->logo_url;
        $partner->delete();
        Storage::disk('uploads')->assertMissing($path);
    }

    public function test_product_table_toggles_and_filters(): void
    {
        $this->actingAs($this->admin);
        $p = Product::where('sku', 'RE01')->first();
        Livewire::test(Resources\Products\Pages\ListProducts::class)
            ->filterTable('on_shopee', true)
            ->searchTable('RE01')
            ->assertCanSeeTableRecords([$p])
            ->call('updateTableColumnState', 'is_featured', (string) $p->id, false);
        $this->assertFalse($p->fresh()->is_featured);
    }
}
