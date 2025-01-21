<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Events\OrderCreated;
use App\Events\OrderSaved;
use App\Models\Scopes\OrderScope;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[ScopedBy([OrderScope::class])]
class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'purchase_cost',
        'payment_method',
        'status',
        'user_id',
        'address_id',
        'payment_gateway_response',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'purchase_cost' => MoneyCast::class,
            'payment_method' => PaymentMethod::class,
            'status' => OrderStatus::class,
        ];
    }

    protected $dispatchesEvents = [
        'created' => OrderCreated::class,
        'saved' => OrderSaved::class,
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::ulid();
        });
    }

    /**
     * @return BelongsTo<Adress, $this>
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<OrderProduct, $this>
     */
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return HasMany<OrderProductSparePart, $this>
     */
    public function orderProductSpareParts(): HasMany
    {
        return $this->hasMany(OrderProductSparePart::class);
    }

    /**
     * @return HasMany<OrderProductComplement, $this>
     */
    public function orderProductComplements(): HasMany
    {
        return $this->hasMany(OrderProductComplement::class);
    }

    public function allPurchasedItems()
    {
        $products = $this->orderProducts()->get();
        $complements = $this->orderProductComplements()->get();
        $spareParts = $this->orderProductSpareParts()->get();

        return $products->concat($complements)->concat($spareParts);
    }
}
