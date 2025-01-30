<?php

namespace App\Events;

use App\Models\BaseProduct;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OutOfStockProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public BaseProduct $product) {}
}
