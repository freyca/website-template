<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\BaseProduct;
use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductHasBeenPurchasedOverStock
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Order $order,
        public BaseProduct $product
    ) {}
}
