<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'order_product';

    protected $fillable = [
        'product_id',
        'unit_price',
        'quantity',
    ];
}
