<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use \App\Support\HasEnglishContent;

    /** Columns with an English twin (<field>_en) shown on the public site in EN. See HasEnglishContent. */
    protected array $englishFields = ['name', 'summary', 'description'];

    use \App\Support\LogsActivity;

    use \App\Support\FlushesSiteCache;

    use HasFactory;

    /** Real photos dropped here override the generated cover (see coverUrl()). */
    public const PHOTO_DIR = 'img/products';

    private const PHOTO_EXTENSIONS = ['webp', 'jpg', 'jpeg', 'png'];

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'name_en',
        'author',
        'slug',
        'summary',
        'summary_en',
        'description',
        'description_en',
        'product_type',
        'education_levels',
        'features',
        'cover_image',
        'shopee_url',
        'on_shopee',
        'on_lms',
        'lms_url',
        'is_free',
        'lms_group',
        'lms_order',
        'status',
        'is_featured',
        'deal_count',
        'sort_order',
        'meta_title',
        'meta_description',
        'faq_mode',
        'faqs',
    ];

    protected $casts = [
        'education_levels' => 'array',
        'features' => 'array',
        'faqs' => 'array',
        'views' => 'integer',
        'is_featured' => 'boolean',
        'on_shopee' => 'boolean',
        'on_lms' => 'boolean',
        'is_free' => 'boolean',
        'deal_count' => 'integer',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name . '-' . $product->sku);
            }
        });

        // Placed in an LMS column (or the free-for-teachers banner) => it is an LMS product
        static::saving(function ($product) {
            if (filled($product->lms_group)) {
                $product->on_lms = true;
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** The homepage LMS column this product sits in (products.lms_group = lms_groups.slug). */
    public function lmsGroup(): BelongsTo
    {
        return $this->belongsTo(LmsGroup::class, 'lms_group', 'slug');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    /**
     * Cover image URL, first match wins:
     *  1. cover_image column (absolute URL or path under public/)
     *  2. public/img/products/{sku}.{webp|jpg|jpeg|png}       e.g. msj01.jpg
     *  3. public/img/products/{name-slug}.{ext}                e.g. microbit-learning-kit.jpg (shared by all variants)
     *  4. generated SVG cover
     */
    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_image) {
            return Str::startsWith($this->cover_image, ['http://', 'https://'])
                ? $this->cover_image
                : asset($this->cover_image);
        }

        return $this->photoUrl() ?? route('products.cover', ['sku' => $this->sku]);
    }

    public function getHasPhotoAttribute(): bool
    {
        return (bool) $this->cover_image || $this->photoUrl() !== null;
    }

    private function photoUrl(): ?string
    {
        // Read the photo folder once per request instead of probing the disk for every product
        static $files = null;
        $files ??= array_flip(array_map('strtolower', array_filter(
            @scandir(public_path(self::PHOTO_DIR)) ?: [],
            fn ($f) => $f[0] !== '.'
        )));

        foreach ([Str::slug($this->sku), Str::slug($this->name)] as $base) {
            foreach (self::PHOTO_EXTENSIONS as $ext) {
                if (isset($files["{$base}.{$ext}"])) {
                    return asset(self::PHOTO_DIR."/{$base}.{$ext}");
                }
            }
        }

        return null;
    }

    /**
     * One row per product title. CRM rows like ECR01..ECR07 share a name and differ only by
     * rombel code, so the catalog shows the lowest-id row and sums deal_count into group_deals.
     */
    public function scopeUniqueTitles(Builder $query): Builder
    {
        $table = $this->getTable();

        return $query
            ->whereIn("{$table}.id", fn ($q) => $q->from($table)->selectRaw('MIN(id)')->where('status', 'published')->groupBy('name'))
            ->addSelect([
                "{$table}.*",
                'group_deals' => static::from("{$table} as g")
                    ->selectRaw('COALESCE(SUM(g.deal_count), 0)')
                    ->whereColumn('g.name', "{$table}.name")
                    ->where('g.status', 'published'),
            ]);
    }

    /** Schools using this title across all rombel rows. */
    public function getTotalDealsAttribute(): int
    {
        return (int) ($this->group_deals ?? $this->deal_count);
    }

    /** Null when the product is not sold on Shopee. */
    public function getShopLinkAttribute(): ?string
    {
        if (! $this->on_shopee) {
            return null;
        }

        return $this->shopee_url ?: config('erlass.shopee');
    }

    /** Line above the title, like a book's author/publisher. */
    public function getAuthorLabelAttribute(): string
    {
        return $this->author ?: ($this->category?->name ?? 'Erlass Academy');
    }

    public function getIsPhysicalAttribute(): bool
    {
        return strcasecmp((string) $this->product_type, 'Fisik') === 0;
    }

    public function getTypeLabelAttribute(): string
    {
        if ($this->on_lms) {
            return match ($this->lms_group) {
                'intrakurikuler' => __('Intrakurikuler LMS'),
                'course' => __('Course LMS'),
                'asesmen' => __('Asesmen LMS'),
                default => __('Platform LMS'),
            };
        }

        return $this->is_physical ? __('Produk Fisik') : __('Program / Layanan');
    }

    public function getLevelsLabelAttribute(): string
    {
        $levels = array_filter((array) $this->education_levels);

        return $levels ? implode(', ', $levels) : __('Semua jenjang');
    }

    /** Badge shown on the card: [label, tailwind classes] or null. */
    public function getBadgeAttribute(): ?array
    {
        if ($this->is_free) {
            return [__('Gratis'), 'bg-emerald-500 text-white'];
        }
        if ($this->total_deals >= 100) {
            return [__('Terlaris'), 'bg-[#ffb703] text-[#023047]'];
        }
        if ($this->on_lms) {
            return ['LMS', 'bg-[#219ebc] text-white'];
        }
        if ($this->is_featured || $this->total_deals >= 10) {
            return [__('Populer'), 'bg-[#fb8500] text-white'];
        }
        if ($this->created_at && $this->created_at->gt(now()->subDays(60))) {
            return [__('Terbaru'), 'bg-[#1d4ed8] text-white'];
        }

        return null;
    }

    public const FAQ_MODES = [
        'template' => 'Pakai template saja',
        'custom' => 'Pertanyaan khusus produk ini saja',
        'both' => 'Template + pertanyaan khusus',
    ];

    /** Values for the {placeholders} in FAQ templates. */
    public function faqVariables(): array
    {
        $features = array_filter((array) $this->features);
        $buy = [];
        if ($this->on_shopee) {
            $buy[] = __(":name juga dapat dibeli di toko Shopee resmi Erlass (:link).", ["name" => $this->name, "link" => $this->shop_link]);
        }
        if ($this->lms_url) {
            $buy[] = __("Akses langsung di LMS Erlass Academy: :url", ["url" => $this->lms_url]);
        }

        return [
            '{produk}' => $this->name,
            '{jenjang}' => $this->levels_label,
            '{kategori}' => $this->category?->name ? __($this->category->name) : __('pendidikan teknologi'),
            '{jenis}' => mb_strtolower($this->type_label),
            '{ringkasan}' => $this->summary ? __($this->summary) : '',
            '{deskripsi}' => (string) ($this->description ?: $this->summary),
            '{fitur}' => $features ? implode('; ', array_map(fn ($x) => __($x), $features)).'.' : (string) ($this->description ?: $this->summary),
            '{sekolah}' => $this->total_deals > 0 ? $this->total_deals.'+' : __('banyak'),
            '{whatsapp}' => (string) config('erlass.phone_display'),
            '{info_pembelian}' => implode(' ', $buy),
            '{shopee}' => (string) config('erlass.shopee'),
        ];
    }

    /**
     * Questions shown on this product's page, placeholders filled in.
     *
     * @return array<int, array{0: string, 1: string}>
     */
    public function faqItems(): array
    {
        $vars = $this->faqVariables();
        $mode = array_key_exists((string) $this->faq_mode, self::FAQ_MODES) ? $this->faq_mode : 'template';
        $items = [];

        if ($mode !== 'custom') {
            $templates = \App\Support\SiteCache::remember('faq.product', 3600, fn () => Faq::where('scope', Faq::SCOPE_PRODUCT)
                ->active()->get(['question', 'answer'])->map(fn ($f) => [$f->question, $f->answer])->all());
            $items = array_merge($items, $templates);
        }
        if ($mode !== 'template') {
            foreach ((array) $this->faqs as $faq) {
                $items[] = [$faq['question'] ?? '', $faq['answer'] ?? ''];
            }
        }

        return array_values(array_filter(
            array_map(fn ($f) => [Faq::render(__($f[0]), $vars), Faq::render(__($f[1]), $vars)], $items),
            fn ($f) => $f[0] !== '' && $f[1] !== ''
        ));
    }

    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: "{$this->name} ({$this->sku})";
    }

    public function getSeoDescriptionAttribute(): string
    {
        // meta_description is written in Indonesian: in English, build it from the translated summary instead
        $english = static::wantsEnglishContent() && ($this->hasEnglish('summary') || $this->hasEnglish('description'));
        if ($this->meta_description && ! $english) {
            return $this->meta_description;
        }

        $text = __(':name dari Erlass Academy untuk jenjang :levels.', ['name' => $this->name, 'levels' => $this->levels_label])
            .' '.($this->summary ?: $this->description);
        if ($this->total_deals > 0) {
            $text .= ' '.__('Digunakan :count+ sekolah mitra.', ['count' => $this->total_deals]);
        }

        return Str::limit(trim($text), 158);
    }
}
