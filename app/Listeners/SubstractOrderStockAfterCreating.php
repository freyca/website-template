<?php

namespace App\Listeners;

use App\Events\LowStockProduct;
use App\Events\OrderCreated;
use App\Events\OutOfStockProduct;
use App\Events\ProductHasBeenPurchasedOverStock;
use App\Models\BaseProduct;
use App\Models\OrderProduct;
use App\Models\OrderProductComplement;
use App\Models\OrderProductSparePart;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
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
        $orderItems = $order->allPurchasedItems();

        foreach ($orderItems as $orderItem) {
            match (true) {
                is_a($orderItem, OrderProduct::class) => $this->substractProductQuantity($orderItem),
                is_a($orderItem, OrderProductSparePart::class) => $this->substractSparePartQuantity($orderItem),
                is_a($orderItem, OrderProductComplement::class) => $this->substractComplementQuantity($orderItem),
                default => throw new Exception('Order should not have this order item '.get_class($orderItem))
            };
        }
    }

    private function substractProductQuantity(OrderProduct $orderItem): void
    {
        if (! is_null($orderItem->product_variant_id)) {
            $this->substractProductVariantQuantity($orderItem);

            return;
        }

        $product = Product::find($orderItem->product_id);
        $product->stock = $product->stock - $orderItem->quantity;

        $this->shouldTriggerStockEvent($product, $orderItem);
        $this->saveProduct($product);
    }

    private function substractProductVariantQuantity(OrderProduct $orderItem): void
    {
        $product = ProductVariant::find($orderItem->product_variant_id);
        $product->stock = $product->stock - $orderItem->quantity;

        $this->shouldTriggerStockEvent($product, $orderItem);
        $this->saveProduct($product);
    }

    private function substractComplementQuantity(OrderProductComplement $orderItem): void
    {
        $product = ProductComplement::find($orderItem->product_complement_id);
        $product->stock = $product->stock - $orderItem->quantity;

        $this->shouldTriggerStockEvent($product, $orderItem);
        $this->saveProduct($product);
    }

    private function substractSparePartQuantity(OrderProductSparePart $orderItem): void
    {
        $product = ProductSparePart::find($orderItem->product_spare_part_id);
        $product->stock = $product->stock - $orderItem->quantity;

        $this->shouldTriggerStockEvent($product, $orderItem);
        $this->saveProduct($product);
    }

    private function saveProduct(BaseProduct $product): void
    {
        if ($product->stock < 0) {
            $product->stock = 0;
        }

        $product->save();
    }

    private function shouldTriggerStockEvent(
        BaseProduct $product,
        OrderProduct|OrderProductComplement|OrderProductSparePart $orderItem
    ): void {
        match (true) {
            $product->stock < 0 => Event::dispatch(
                ProductHasBeenPurchasedOverStock::class,
                [
                    $orderItem->order,
                    $orderItem->product,
                ]
            ),
            $product->stock === 0 => Event::dispatch(
                OutOfStockProduct::class,
                [$orderItem->product]
            ),
            $product->stock < 10 => Event::dispatch(
                LowStockProduct::class,
                [$orderItem->product]
            ),
            default => true,
        };
    }
}
