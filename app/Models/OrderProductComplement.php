<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductComplement extends Model
{
    use HasFactory;

    protected $table = 'order_product_complement';

    protected $fillable = [
        'product_complement_id',
        'unit_price',
        'quantity',
    ];
}
