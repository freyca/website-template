<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductComplement extends BaseProduct
{
    protected $fillable = [
        'name',
        'price',
        'price_with_discount',
        'price_when_user_owns_product',
        'published',
        'stock',
        'slogan',
        'meta_description',
        'short_description',
        'description',
        'main_image',
        'images',
    ];

    /**
     * @return BelongsToMany<Product>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return Collection<int, Category>
     */
    public function categories(): Collection
    {
        return Category::whereIn('id', $this->products->pluck('category_id')->unique())->get();
    }
}
