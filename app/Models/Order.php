<?php

namespace App\Models;

use App\Enums\PaymentMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_cost',
        'payment_method',
        'its_payed',
        'customer_id',
    ];

    protected function casts()
    {
        return [
            'payment_method' => PaymentMethods::class,
        ];
    }
}
