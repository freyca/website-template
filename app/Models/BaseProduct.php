<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property float $price
 * @property float $price_with_discount
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
 */
abstract class BaseProduct extends Model
{
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'images' => 'array',
    ];

    /**
     * @return BelongsToMany<Order>
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * @return BelongsToMany<ProductFeature>
     */
    public function productFeatures(): BelongsToMany
    {
        return $this->belongsToMany(ProductFeature::class);
    }
}
