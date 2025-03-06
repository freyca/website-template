<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use Database\Factories\OrderProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    /** @use HasFactory<OrderProductFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'order_product';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'unit_price' => MoneyCast::class,
            'assembly_price' => MoneyCast::class,
        ];
    }

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id',
        'unit_price',
        'assembly_price',
        'quantity',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        if ($this->product_variant_id === null) {
            return $this->belongsTo(Product::class);
        }

        return $this->productVariant();
    }

    private function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
