<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\LowStockProduct;
use App\Events\OrderCreated;
use App\Events\OutOfStockProduct;
use App\Events\ProductHasBeenPurchasedOverStock;
use App\Models\BaseProduct;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Event;

/**
 * If listener runs sincronously, the relations will not be created, so the stock
 * will not be substracted
 */
class SubstractOrderStockAfterCreating implements ShouldQueue
{
    /**
     * The time (seconds) before the job should be processed.
     * This way we are we avoid race conditions, since the queue runner could
     * be run before the relations are saved
     */
    public int $delay = 10;

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        $orderItems = $order->orderProducts;

        foreach ($orderItems as $orderItem) {
            if (! is_null($orderItem->product_variant_id)) {
                $this->substractProductVariantQuantity($orderItem);

                continue;
            }

            $class_name = $orderItem->orderable_type;
            $product = $class_name::find($orderItem->orderable_id);
            $new_stock = $product->stock - $orderItem->quantity;

            if ($new_stock < 0) {
                $this->shouldTriggerStockEvent($product, $orderItem);
                $new_stock = 0;
            }

            $product->stock = $new_stock;

            $this->shouldTriggerStockEvent($product, $orderItem);
            $this->saveProduct($product);
        }
    }

    private function substractProductVariantQuantity(OrderProduct $orderItem): void
    {
        $product = ProductVariant::find($orderItem->product_variant_id);

        if (is_null($product)) {
            throw new Exception('NULL product');
        }

        $product->stock = $product->stock - $orderItem->quantity;

        $this->shouldTriggerStockEvent($product, $orderItem);
        $this->saveProduct($product);
    }

    private function saveProduct(BaseProduct|ProductVariant $product): void
    {
        if ($product->stock < 0) {
            $product->stock = 0;
        }

        $product->save();
    }

    // TODO: implement this logic
    private function shouldTriggerStockEvent(
        BaseProduct|ProductVariant $product,
        OrderProduct $orderItem
    ): void {
        // match (true) {
        //    $product->stock < 0 => Event::dispatch(
        //        ProductHasBeenPurchasedOverStock::class,
        //        [
        //            $orderItem->order,
        //            $orderItem->product,
        //        ]
        //    ),
        //    $product->stock === 0 => Event::dispatch(
        //        OutOfStockProduct::class,
        //        [$orderItem->product]
        //    ),
        //    $product->stock < 10 => Event::dispatch(
        //        LowStockProduct::class,
        //        [$orderItem->product]
        //    ),
        //    default => true,
        // };
    }
}
