<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'status'];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the products associated with the brand.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id', 'id')->where('status', 'active');
    }

    /**
     * Get products by brand slug.
     *
     * @param string $slug
     * @return Brand|null
     */
    public static function getProductByBrand(string $slug): ?Brand
    {
        return self::with('products')->where('slug', $slug)->firstOrFail();
    }
}
