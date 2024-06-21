<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductSparePart extends BaseProduct
{
    /**
     * Create a new Eloquent model instance.
     *
     * @param  array<string>  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['price_when_user_owns_product']);
    }

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
     * @return BelongsToMany<ProductFeature>
     */
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(ProductFeature::class);
    }
}
