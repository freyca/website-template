<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use App\Models\Scopes\PublishedScope;
use App\Models\Traits\HasSlug;
use App\Traits\CurrencyFormatter;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
 * @property BelongsToMany<ProductFeatureValue, $this> $productFeatureValues
 */
#[ScopedBy([PublishedScope::class])]
abstract class BaseProduct extends Model
{
    use CurrencyFormatter;
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

    public function getFormattedPrice(): string
    {
        $price = $this->price === null ? floatval(0) : $this->price;

        return $this->formatCurrency($price);
    }

    public function getFormattedPriceWithDiscount(): string
    {
        $price_with_discount = $this->price_with_discount === null ? floatval(0) : $this->price_with_discount;

        return $this->formatCurrency($price_with_discount);
    }

    public function getFormattedSavings(): string
    {
        $savings = floatval($this->price - $this->price_with_discount);

        return $this->formatCurrency($savings);
    }

    /**
     * @return MorphMany<Order, $this>
     */
    public function orders(): MorphMany
    {
        return $this->morphMany(Order::class);
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
