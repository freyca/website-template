<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use Database\Factories\OrderProductSparePartFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductSparePart extends Model
{
    /** @use HasFactory<OrderProductSparePartFactory> */
    use HasFactory;

    protected $table = 'order_product_spare_part';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'unit_price' => MoneyCast::class,
        ];
    }

    protected $fillable = [
        'product_spare_part_id',
        'unit_price',
        'quantity',
    ];
}
