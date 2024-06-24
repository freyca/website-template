<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductVariant extends BaseProduct
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'ean13',
        'price',
        'price_with_discount',
        'stock',
    ];

    /**
     * Product variant does not has a slug, it inherits parent Product slug
     * We override the trait so it does not interferes when saving to db
     */
    public static function bootHasSlug(): void
    {

    }

    /**
     * @return BelongsTo<Product, ProductVariant>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsToMany<ProductFeatureValue>
     */
    public function productFeatureValues(): BelongsToMany
    {
        return $this->belongsToMany(ProductFeatureValue::class);
    }
}
