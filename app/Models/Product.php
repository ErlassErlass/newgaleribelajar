<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'slug',
        'summary',
        'description',
        'product_type',
        'education_levels',
        'features',
        'cover_image',
        'status',
        'is_featured',
        'deal_count',
        'sort_order',
    ];

    protected $casts = [
        'education_levels' => 'array',
        'features' => 'array',
        'is_featured' => 'boolean',
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
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
