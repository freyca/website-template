<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductComplement extends BaseProduct
{
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

    /**
     * @return BelongsToMany<ProductFeatureValue>
     */
    public function productFeatureValues(): BelongsToMany
    {
        return $this->belongsToMany(ProductFeatureValue::class);
    }
}
