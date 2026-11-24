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

    public function test_public_pages_load(): void
    {
        $article = Article::published()->first();
        $product = Product::published()->where('sku', 'MLK01')->first();

        $ok = [
            '/', '/katalog', '/katalog?kategori=robotika-edukasi', '/katalog?jenjang=SMP&jenis=fisik',
            '/katalog?tersedia=shopee', '/katalog?tersedia=lms', '/katalog?q=scratch&urut=nama', '/katalog?urut=dilihat',
            '/katalog?urut=terbaru', '/katalog?page=2', '/katalog/'.$product->slug, '/katalog/cover/MSJ01.svg',
            '/artikel', '/artikel?kategori=kompetisi', '/artikel?q=coding', '/artikel/'.$article->slug,
            '/gallery', '/gallery?kategori=siswa', '/gallery?kategori=siswa&sub=robotika', '/gallery?kategori=guru',
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
