<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $ean13
 * @property string $slug
 * @property string $name
 * @property float $price
 * @property ?float $price_with_discount
 * @property bool $published
 * @property int $stock
 * @property float $dimension_length
 * @property float $dimension_width
 * @property float $dimension_height
 * @property float $dimension_weight
 * @property string $slogan
 * @property string $meta_description
 * @property string $short_description
 * @property string $description
 * @property string $main_image
 * @property array<string> $images
 * @property BelongsToMany<ProductFeatureValue> $productFeatureValues
 */
abstract class BaseProduct extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'ean13',
        'slug',
        'price',
        'price_with_discount',
        'published',
        'stock',
        'dimension_length',
        'dimension_width',
        'dimension_height',
        'dimension_weight',
        'slogan',
        'meta_description',
        'short_description',
        'description',
        'main_image',
        'images',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => MoneyCast::class,
            'price_with_discount' => MoneyCast::class,
            'images' => 'array',
        ];
    }

    /**
     * @return BelongsToMany<Order, $this>
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * @return Collection<int, ProductFeature>
     */
    public function productFeatures(): Collection
    {
        return ProductFeature::whereIn(
            'id',
            $this->productFeatureValues
                ->pluck('product_feature_id')
                ->unique()
        )->get();
    }
}
