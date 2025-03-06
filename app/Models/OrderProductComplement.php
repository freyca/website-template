<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use Database\Factories\OrderProductComplementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductComplement extends Model
{
    /** @use HasFactory<OrderProductComplementFactory> */
    use HasFactory;

    protected $table = 'order_product_complement';

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
        'order_id',
        'product_complement_id',
        'unit_price',
        'quantity',
    ];
}
