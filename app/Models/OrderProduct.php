<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\OrderProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    /** @use HasFactory<OrderProductFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'order_product';

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'unit_price',
        'quantity',
    ];
}
