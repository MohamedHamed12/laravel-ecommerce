<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'summary', 'photo', 'status',
        'is_parent', 'parent_id', 'added_by'
    ];

    protected $casts = [
        'is_parent' => 'boolean',
    ];

    /**
     * Get parent category info.
     */
    public function parentInfo(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    /**
     * Get all categories with parent info.
     */
    public static function getAllCategory(): mixed
    {
        return self::with('parentInfo')->orderByDesc('id')->paginate(10);
    }

    /**
     * Shift child categories to parent.
     */
    public static function shiftChild(array $catIds): bool
    {
        return self::whereIn('id', $catIds)->update(['is_parent' => true]);
    }

    /**
     * Get child categories by parent ID.
     */
    public static function getChildByParentID(int $id): Collection
    {
        return self::where('parent_id', $id)->orderBy('id', 'ASC')->pluck('title', 'id');
    }

    /**
     * Get child categories.
     */
    public function childCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->where('status', 'active');
    }

    /**
     * Get all parent categories with their children.
     */
    public static function getAllParentWithChild(): mixed
    {
        return self::with('childCategories')
            ->where('is_parent', true)
            ->where('status', 'active')
            ->orderBy('title', 'ASC')
            ->get();
    }

    /**
     * Get products under a category.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'cat_id', 'id')
            ->where('status', 'active');
    }

    /**
     * Get products under a sub-category.
     */
    public function subProducts(): HasMany
    {
        return $this->hasMany(Product::class, 'child_cat_id', 'id')
            ->where('status', 'active');
    }

    /**
     * Get products by category slug.
     */
    public static function getProductByCat(string $slug): ?Category
    {
        return self::with('products')->where('slug', $slug)->firstOrFail();
    }

    /**
     * Get products by sub-category slug.
     */
    public static function getProductBySubCat(string $slug): ?Category
    {
        return self::with('subProducts')->where('slug', $slug)->firstOrFail();
    }

    /**
     * Count active categories.
     */
    public static function countActiveCategory(): int
    {
        return self::where('status', 'active')->count();
    }
}
