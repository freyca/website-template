<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductFeatureValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature_id',
        'name',
        'description',
    ];

    /**
     * @return BelongsTo<ProductFeature, ProductFeatureValue>
     */
    public function productFeature(): BelongsTo
    {
        return $this->belongsTo(ProductFeature::class);
    }

    /**
     * @return BelongsToMany<Product>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return BelongsToMany<ProductComplement>
     */
    public function productComplements(): BelongsToMany
    {
        return $this->belongsToMany(ProductComplement::class);
    }

    /**
     * @return BelongsToMany<ProductSparePart>
     */
    public function productSpareParts(): BelongsToMany
    {
        return $this->belongsToMany(ProductSparePart::class);
    }

    public static function allProducts(int $id): ?self
    {
        return self::with(
            [
                'products',
                'productSpareParts',
                'productComplements',
            ]
        )->find($id);
    }
}
