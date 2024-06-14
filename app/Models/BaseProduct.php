<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property float $price_with_discount
 * @property bool $published
 * @property int $stock
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
