<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ProductSparePartFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductSparePart extends BaseProduct
{
    /** @use HasFactory<ProductSparePartFactory> */
    use HasFactory;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array<string>  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->mergeFillable(['price_when_user_owns_product']);

        parent::__construct($attributes);
    }

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
