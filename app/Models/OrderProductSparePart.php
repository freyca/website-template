<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductSparePart extends Model
{
    use HasFactory;

    protected $table = 'order_product_spare_part';

    protected $fillable = [
        'product_spare_part_id',
        'unit_price',
        'quantity',
    ];
}
