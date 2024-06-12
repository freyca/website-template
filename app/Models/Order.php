<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_cost',
        'payment_method',
        'payed',
        'customer_id',
    ];

    protected function casts()
    {
        return [
            'payment_method' => PaymentMethods::class,
        ];
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
