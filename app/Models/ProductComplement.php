<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasPriceWhenUserOwnsProduct;
use Database\Factories\ProductComplementFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductComplement extends BaseProduct
{
    /** @use HasFactory<ProductComplementFactory> */
    use HasFactory;

    use HasPriceWhenUserOwnsProduct;

    /**
     * @return BelongsToMany<Product, $this>
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
     * @return BelongsToMany<ProductFeatureValue, $this>
     */
    public function productFeatureValues(): BelongsToMany
    {
        return $this->belongsToMany(ProductFeatureValue::class);
    }
}
