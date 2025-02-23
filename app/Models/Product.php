<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\ProductDeleted;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends BaseProduct
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array<string>  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->mergeFillable(['category_id']);

        parent::__construct($attributes);
    }

    /**
     * The event map for the model.
     *
     * @var array<string, string>
     */
    protected $dispatchesEvents = [
        'deleting' => ProductDeleted::class,
    ];

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany<ProductComplement, $this>
     */
    public function productComplements(): BelongsToMany
    {
        return $this->belongsToMany(ProductComplement::class);
    }

    /**
     * @return BelongsToMany<ProductSparePart, $this>
     */
    public function productSpareParts(): BelongsToMany
    {
        return $this->belongsToMany(ProductSparePart::class);
    }

    /**
     * @return BelongsToMany<ProductFeatureValue, $this>
     */
    public function productFeatureValues(): BelongsToMany
    {
        return $this->belongsToMany(ProductFeatureValue::class);
    }

    /**
     * @return HasMany<ProductVariant, $this>
     */
    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
