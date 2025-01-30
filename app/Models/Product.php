<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'summary', 'description', 'cat_id', 'child_cat_id',
        'price', 'brand_id', 'discount', 'status', 'photo', 'size', 'stock',
        'is_featured', 'condition'
    ];

    /**
     * Get parent category information.
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'cat_id');
    }

    /**
     * Get sub-category information.
     */
    public function subCategory(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'child_cat_id');
    }

    /**
     * Get all products with categories.
     */
    public static function getAllProduct(): mixed
    {
        return self::with(['category', 'subCategory'])->orderByDesc('id')->paginate(10);
    }

    /**
     * Get related products.
     */
    public function relatedProducts(): HasMany
    {
        return $this->hasMany(Product::class, 'cat_id', 'cat_id')
            ->where('status', 'active')
            ->orderByDesc('id')
            ->limit(8);
    }

    /**
     * Get product reviews.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id')
            ->with('user_info')
            ->where('status', 'active')
            ->orderByDesc('id');
    }

    /**
     * Get product by slug.
     */
    public static function getProductBySlug(string $slug): ?Product
    {
        return self::with(['category', 'relatedProducts', 'reviews'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Count active products.
     */
    public static function countActiveProduct(): int
    {
        return self::where('status', 'active')->count();
    }

    /**
     * Get carts containing this product.
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    /**
     * Get wishlists containing this product.
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

    /**
     * Get brand associated with the product.
     */
    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
}
