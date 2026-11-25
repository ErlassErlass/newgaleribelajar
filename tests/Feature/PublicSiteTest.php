<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** Every public page and form. In-memory SQLite (phpunit.xml), never touches MySQL. */
class PublicSiteTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_navbar_search_language_and_lms_strip(): void
    {
        $group = \App\Models\LmsGroup::active()
            ->where('slug', '!=', \App\Models\LmsGroup::BANNER)
            ->whereHas('products', fn ($q) => $q->published())
            ->firstOrFail();

        $this->get('/')
            ->assertOk()
            ->assertSee('id="nav-search"', false)
            ->assertSee('name="q"', false)
            ->assertSee(route('lang.switch', 'en'), false)
            ->assertSee('href="'.route('lms.index').'"', false) // LMS badge beside search
            ->assertSee('href="'.route('lms.index').'#lms-'.$group->slug.'"', false) // homepage: one button per column...
            ->assertDontSee('id="lms-'.$group->slug.'"', false);                      // ...the columns themselves live on /lms

        // The /lms page the badge opens: every LMS column with its products
        $res = $this->get('/lms')->assertOk()
            ->assertSee('aria-current="page"', false)
            ->assertSee('#lms-'.$group->slug, false)
            ->assertSee('id="lms-'.$group->slug.'"', false)
            ->assertSee($group->title);
        foreach ($group->products()->published()->get() as $product) {
            $res->assertSee($product->name);
        }
        $this->get('/sitemap.xml')->assertSee(route('lms.index'), false);

        // Switching language translates the header and sticks for the session
        $this->from('/katalog')->get('/lang/en')->assertRedirect('/katalog');
        $this->get('/katalog')->assertOk()->assertSee('Product Catalog')->assertSee('Erlass Academy LMS')->assertSee('<html lang="en"', false);
        $this->get('/lang/xx')->assertRedirect();
        $this->get('/')->assertSee('<html lang="en"', false);
    }

    public function test_english_mode_translates_every_public_page(): void
    {
        $article = Article::published()->first();
        $product = Product::published()->first();
        $this->get('/lang/en');

        // Every page still renders in English (a bad __() key can return an array and crash a view)
        foreach (['/', '/lms', '/katalog', '/katalog?jenis=jasa', '/katalog/'.$product->slug, '/artikel', '/artikel/'.$article->slug, '/gallery', '/kebijakan-privasi', '/syarat-ketentuan'] as $url) {
            $this->get($url)->assertOk();
        }

        // Interface text, homepage settings, labels and FAQ templates come out in English…
        $this->get('/')->assertOk()
            ->assertSee('Explore Products')
            ->assertSee('Building a Creative Generation Through')   // hero title from homepage settings
            ->assertSee('Monday – Friday')                          // office hours in the footer
            ->assertDontSee('Membangun Generasi Kreatif')
            ->assertSee('Integrated Education Solutions for Your School')
            ->assertSee('Teacher Resource Center')
            ->assertSee('Subscribe to Our Newsletter')
            ->assertDontSee('Jelajahi Produk')
            ->assertDontSee('Berlangganan Buletin Informasi')
            ->assertDontSee('Dipercaya oleh'); // top announcement bar was removed
        $this->get('/katalog')->assertOk()->assertSee('Catalog FAQ')->assertSee('Which school levels are Erlass products for?');
        $this->get('/kebijakan-privasi')->assertOk()->assertSee('Data We Collect');

        // Database content: products and articles use their English columns
        $scratch = Product::where('name', 'Modul Scratch Jilid 2')->firstOrFail();
        $this->get('/katalog/'.$scratch->slug)->assertOk()
            ->assertSee('Scratch Module Vol. 2')
            ->assertSee('learning package (code: '.$scratch->sku.')', false)
            ->assertDontSee('Paket pembelajaran')
            ->assertDontSee('Program edukasi teknologi');
        $this->get('/artikel/dokumentasi-kelas-robotika-sekolah-mitra')->assertOk()
            ->assertSee('Activity Highlights: Robotics Class at a Partner School')
            ->assertSee('Erlass robotics classes are designed so students learn by doing.')
            ->assertSee('0 comments')
            ->assertDontSee('Kelas robotika Erlass dirancang');

        // Search also matches the English texts
        $this->get('/artikel?q=Robotics+Class')->assertOk()->assertSee('Activity Highlights: Robotics Class at a Partner School');
        $this->get('/katalog?q=Scratch+Module')->assertOk()->assertSee('Scratch Module Vol. 2');

        // …and switching back restores Indonesian
        $this->get('/lang/id');
        $this->get('/')->assertOk()->assertSee('Jelajahi Produk')->assertDontSee('Explore Products');
        $this->get('/katalog/'.$scratch->slug)->assertOk()->assertSee('Modul Scratch Jilid 2')->assertSee('Paket pembelajaran');
        $this->get('/artikel/dokumentasi-kelas-robotika-sekolah-mitra')->assertOk()->assertSee('Kelas robotika Erlass dirancang');

        // Outside public pages (admin, console) models always give the Indonesian original to edit
        config(['erlass.content_locale' => null]);
        $this->assertSame('Modul Scratch Jilid 2', $scratch->fresh()->name);
    }

    public function test_public_pages_load(): void
    {
        $article = Article::published()->first();
        $product = Product::published()->where('sku', 'MLK01')->first();

        $ok = [
            '/', '/katalog', '/katalog?kategori=robotika-edukasi', '/katalog?jenjang=SMP&jenis=fisik',
            '/katalog?tersedia=shopee', '/katalog?tersedia=lms', '/katalog?q=scratch&urut=nama', '/katalog?urut=dilihat',
            '/katalog?urut=terbaru', '/katalog?page=2', '/katalog/'.$product->slug, '/katalog/cover/MSJ01.svg',
            '/artikel', '/artikel?kategori=kompetisi', '/artikel?q=coding', '/artikel/'.$article->slug,
            '/lms', '/gallery', '/gallery?kategori=siswa', '/gallery?kategori=siswa&sub=robotika', '/gallery?kategori=guru',
            '/kebijakan-privasi', '/syarat-ketentuan', '/sitemap.xml', '/llms.txt', '/admin/login',
        ];
        foreach ($ok as $url) {
            $this->get($url)->assertOk();
        }

        $this->get('/katalog/tidak-ada')->assertNotFound();
        $this->get('/artikel/tidak-ada')->assertNotFound();
        $this->get('/katalog/cover/TIDAK-ADA.svg')->assertNotFound();
    }

    public function test_homepage_content(): void
    {
        $html = $this->get('/')->assertOk()->getContent();
        foreach (['Intrakurikuler dengan LMS', 'Course dengan LMS', 'Asesmen dengan LMS', 'Pusat Sumber Daya Guru', 'Katalog Unggulan', 'Senin – Jumat: 08:00 – 16:00 WIB'] as $text) {
            $this->assertStringContainsString($text, $html, "Homepage misses: $text");
        }
    }

    public function test_structured_data_is_valid_json(): void
    {
        $product = Product::published()->where('sku', 'MLK01')->first();
        foreach (['/', '/katalog', '/katalog/'.$product->slug, '/artikel', '/artikel/'.Article::published()->first()->slug] as $url) {
            preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $this->get($url)->getContent(), $m);
            $this->assertNotEmpty($m[1], "No JSON-LD on $url");
            foreach ($m[1] as $json) {
                $this->assertNotNull(json_decode($json), "Invalid JSON-LD on $url");
            }
        }
        $this->assertNotFalse(simplexml_load_string($this->get('/sitemap.xml')->getContent()));
    }

    public function test_rombel_duplicates_redirect_and_titles_are_unique(): void
    {
        $this->get('/katalog/ekskul-coding-scratch-ecr03')->assertRedirect('/katalog/ekskul-coding-scratch-ecr01');
        $titles = Product::published()->uniqueTitles()->pluck('name');
        $this->assertSame($titles->count(), $titles->unique()->count());
    }

    public function test_product_views_count_once_per_session(): void
    {
        $product = Product::where('sku', 'MLK01')->first();
        $this->get('/katalog/'.$product->slug);
        $this->get('/katalog/'.$product->slug);
        $this->assertSame(1, $product->fresh()->views);
    }

    public function test_comment_moderation_and_contact_collection(): void
    {
        $article = Article::published()->first();

        $this->post("/artikel/{$article->slug}/komentar", ['name' => 'Budi', 'email' => 'budi@test.local', 'body' => 'Artikel yang bermanfaat!', 'marketing_consent' => '1'])
            ->assertRedirect();
        $this->post("/artikel/{$article->slug}/komentar", ['name' => 'Iseng', 'email' => 'iseng@test.local', 'body' => 'dasar g0bl0k'])
            ->assertRedirect();

        $this->assertTrue(ArticleComment::where('email', 'budi@test.local')->first()->is_approved);
        $rude = ArticleComment::where('email', 'iseng@test.local')->first();
        $this->assertFalse($rude->is_approved);
        $this->assertTrue($rude->is_flagged);

        $this->assertTrue(Contact::where('email', 'budi@test.local')->first()->marketing_consent);
        $this->assertFalse(Contact::where('email', 'iseng@test.local')->first()->marketing_consent);
    }

    public function test_newsletter_and_lead_forms(): void
    {
        $this->post('/berlangganan', ['email' => 'news@test.local'])->assertRedirect();
        $this->assertDatabaseHas('subscribers', ['email' => 'news@test.local']);

        $this->post('/leads', ['type' => 'consultation', 'name' => 'Sekolah Uji', 'phone' => '081234567890', 'email' => 'lead@test.local', 'consent_given' => '1'])
            ->assertSessionHas('success');
        $this->assertTrue(Contact::where('email', 'lead@test.local')->first()->marketing_consent);
    }

    public function test_security_headers(): void
    {
        $res = $this->get('/');
        $res->assertHeader('X-Content-Type-Options', 'nosniff');
        $res->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $this->assertNotNull($res->headers->get('Content-Security-Policy')); // APP_ENV=testing is not "local"
    }
}
