<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Product;
use App\Support\SiteCache;

/**
 * /llms.txt (llmstxt.org): a plain Markdown summary of the site so generative engines
 * (ChatGPT, Perplexity, Claude, Gemini / AI Overviews) can quote accurate facts and link back.
 */
class LlmsController extends Controller
{
    public function __invoke()
    {
        $body = SiteCache::remember('llms.txt', 21600, function () {
            $erlass = config('erlass');
            $categories = Category::where('is_active', true)->orderBy('sort_order')
                ->with(['products' => fn ($q) => $q->published()->orderByDesc('on_shopee')->orderByDesc('deal_count')])
                ->get();

            $out = [];
            $out[] = '# '.$erlass['brand'].' ('.$erlass['company'].')';
            $out[] = '';
            $out[] = '> Erlass Academy adalah penyedia solusi pendidikan teknologi untuk sekolah di Indonesia: '
                .'ekskul & intrakurikuler Coding (Scratch, Python, Pictoblox AI), Robotika, Micro:bit & IoT, '
                .'modul cetak & LKPD, LMS sekolah, dan asesmen minat bakat siswa, selaras Kurikulum Merdeka. '
                .'Dipercaya '.Partner::count().'+ sekolah mitra.';
            $out[] = '';
            $out[] = '- Situs: '.route('home');
            $out[] = '- Katalog produk: '.route('products.index');
            $out[] = '- Platform LMS: '.$erlass['lms'];
            $out[] = '- Toko Shopee resmi: '.$erlass['shopee'];
            $out[] = '- WhatsApp: '.$erlass['phone_display'].' (https://wa.me/'.$erlass['whatsapp'].')';
            $out[] = '- Email: '.$erlass['email'];
            $out[] = '- Kantor pusat: '.$erlass['address_hq'];
            $out[] = '- Jam layanan: '.preg_replace('/\R+/', '; ', trim($erlass['office_hours']));
            $out[] = '';

            foreach ($categories as $cat) {
                if ($cat->products->isEmpty()) {
                    continue;
                }
                $out[] = '## '.$cat->name;
                $out[] = '';
                if ($cat->description) {
                    $out[] = $cat->description;
                    $out[] = '';
                }
                // One line per product name; variants (same name, different SKU) are folded together
                foreach ($cat->products->groupBy('name') as $name => $items) {
                    $first = $items->first();
                    $deals = $items->sum('deal_count');
                    $out[] = '- ['.$name.']('.route('products.show', $first->slug).'): '
                        .$first->type_label.', jenjang '.$first->levels_label
                        .($deals > 0 ? ', dipakai '.$deals.'+ sekolah' : '')
                        .($first->is_free ? ', gratis' : '')
                        .($first->on_shopee ? ', tersedia di Shopee Erlass' : '')
                        .($first->lms_url ? ', akses: '.$first->lms_url : '')
                        .'.';
                }
                $out[] = '';
            }

            $articles = Article::published()->take(20)->get(['title', 'slug', 'excerpt']);
            if ($articles->isNotEmpty()) {
                $out[] = '## Artikel';
                $out[] = '';
                foreach ($articles as $a) {
                    $out[] = '- ['.$a->title.']('.route('articles.show', $a->slug).')'.($a->excerpt ? ': '.$a->excerpt : '');
                }
                $out[] = '';
            }

            $out[] = '## Optional';
            $out[] = '';
            $out[] = '- [Sitemap]('.route('sitemap').')';
            $out[] = '- [Kebijakan Privasi]('.route('privacy').')';
            $out[] = '- [Syarat & Ketentuan]('.route('terms').')';

            return implode("\n", $out)."\n";
        });

        return response($body, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
