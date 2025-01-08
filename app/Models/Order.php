<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Scopes\OrderScope;
use Creagia\LaravelRedsys\Concerns\CanCreateRedsysRequests;
use Creagia\LaravelRedsys\Contracts\RedsysPayable;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

#[ScopedBy([OrderScope::class])]
class Order extends Model implements RedsysPayable
{
    use CanCreateRedsysRequests;

    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'purchase_cost',
        'payment_method',
        'status',
        'user_id',
        'user_metadata_id',
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

    protected $keyType = 'string';

    public $incrementing = false;

    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::ulid();
        });
    }

    public function getTotalAmount(): int
    {
        $cost = round(floatval($this->purchase_cost) * 100, 2);

        return intval(Number::trim($cost));
    }

    public function paidWithRedsys(): void
    {
        // Notify user, change status to paid, ...
    }

    /**
     * @return BelongsTo<UserMetadata, $this>
     */
    public function userMetadata(): BelongsTo
    {
        return $this->belongsTo(UserMetadata::class);
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
