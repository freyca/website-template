<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethods;
use App\Models\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ScopedBy([OrderScope::class])]
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_cost',
        'payment_method',
        'status',
        'user_id',
    ];

    protected $casts = [
        'payment_method' => PaymentMethods::class,
        'status' => OrderStatus::class,
    ];

    /**
     * @return BelongsTo<User, Order>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<OrderProduct>
     */
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return HasMany<OrderProductSparePart>
     */
    public function orderProductSpareParts(): HasMany
    {
        return $this->hasMany(OrderProductSparePart::class);
    }

    /**
     * @return HasMany<OrderProductComplement>
     */
    public function orderProductComplements(): HasMany
    {
        return $this->hasMany(OrderProductComplement::class);
    }

    public static function allPurchasedItems(int $id): ?self
    {
        return self::with(
            [
                'orderProducts',
                'orderProductSpareParts',
                'orderProductComplements',
            ]
        )->find($id);
    }
}
