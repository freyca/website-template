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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * @return BelongsToMany<Product>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return BelongsToMany<ProductSparePart>
     */
    public function productSpareParts(): BelongsToMany
    {
        return $this->belongsToMany(ProductSparePart::class);
    }

    /**
     * @return BelongsToMany<ProductComplement>
     */
    public function productComplements(): BelongsToMany
    {
        return $this->belongsToMany(ProductComplement::class);
    }

    public function allPurchasedItems(): self
    {
        /** @var Order */
        return $this::with(['products', 'productComplements', 'productSpareParts'])->find($this->id);
    }
}
