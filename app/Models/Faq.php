<?php

namespace App\Models;

use App\Support\FlushesSiteCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use \App\Support\LogsActivity;

    use FlushesSiteCache;

    public const SCOPE_CATALOG = 'catalog';
    public const SCOPE_PRODUCT = 'product';

    public const SCOPES = [
        self::SCOPE_CATALOG => 'Seputar Katalog',
        self::SCOPE_PRODUCT => 'Template Pertanyaan Produk',
    ];

    /** Placeholders available in product templates, with a description for the admin form. */
    public const PLACEHOLDERS = [
        '{produk}' => 'Nama produk',
        '{jenjang}' => 'Jenjang, mis. "SD, SMP"',
        '{kategori}' => 'Kategori produk',
        '{jenis}' => 'Produk Fisik / Program / Course LMS ...',
        '{ringkasan}' => 'Ringkasan produk',
        '{deskripsi}' => 'Deskripsi produk',
        '{fitur}' => 'Daftar "yang didapat sekolah"',
        '{sekolah}' => 'Jumlah sekolah pengguna, mis. "260+"',
        '{whatsapp}' => 'Nomor WhatsApp Erlass',
        '{info_pembelian}' => 'Kalimat Shopee / LMS bila produk tersedia di sana (kosong bila tidak)',
        '{total_produk}' => 'Jumlah produk di katalog (untuk FAQ katalog)',
        '{kategori_katalog}' => 'Daftar kategori katalog (untuk FAQ katalog)',
        '{shopee}' => 'Link toko Shopee',
    ];

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    /** Replace {placeholders}; unknown ones are left as-is so typos are easy to spot. */
    public static function render(string $text, array $vars): string
    {
        return trim(preg_replace('/\s{2,}/', ' ', strtr($text, $vars)));
    }
}
