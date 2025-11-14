<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'long_description',
        'image',
        'price',
        'discount_price',
        'discount_percent',
        'category_id',
        'stock',
        'status',
        'sku',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'discount_percent' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all images for the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * Calculate discount percent automatically.
     */
    public function calculateDiscountPercent()
    {
        if ($this->discount_price && $this->price > 0) {
            $this->discount_percent = round((($this->price - $this->discount_price) / $this->price) * 100, 2);
        } else {
            $this->discount_percent = null;
        }
    }

    /**
     * Scope to get only active products.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
