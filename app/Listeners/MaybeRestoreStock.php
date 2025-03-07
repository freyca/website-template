<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\OrderStatus;
use App\Events\OrderSaved;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductComplement;
use App\Models\OrderProductSparePart;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Models\ProductVariant;
use Exception;

class MaybeRestoreStock
{
    public function handle(OrderSaved $event): void
    {
        $order = $event->order;

        if ($order->wasChanged('status') && $order->status === OrderStatus::Cancelled) {
            $this->restoreStock($order);
        }
    }

    private function restoreStock(Order $order): void
    {
        $orderItems = $order->allPurchasedItems();

        foreach ($orderItems as $orderItem) {
            match (true) {
                is_a($orderItem, OrderProduct::class) => $this->restoreCancelledProductQuantity($orderItem),
                is_a($orderItem, OrderProductSparePart::class) => $this->restoreCancelledSparePartQuantity($orderItem),
                is_a($orderItem, OrderProductComplement::class) => $this->restoreCancelledComplementQuantity($orderItem),
                default => throw new Exception('Order should not have this order item '.get_class($orderItem))
            };
        }
    }

    private function restoreCancelledProductQuantity(OrderProduct $orderItem): void
    {
        if (! is_null($orderItem->product_variant_id)) {
            $this->restoreProductVariantQuantity($orderItem);

            return;
        }

        $product = Product::find($orderItem->product_id);
        $product->stock = $product->stock + $orderItem->quantity;
        $product->save();
    }

    private function restoreProductVariantQuantity(OrderProduct $orderItem): void
    {
        $product = ProductVariant::find($orderItem->product_variant_id);
        $product->stock = $product->stock + $orderItem->quantity;
        $product->save();
    }

    private function restoreCancelledSparePartQuantity(OrderProductSparePart $orderItem): void
    {
        $product = ProductSparePart::find($orderItem->product_spare_part_id);
        $product->stock = $product->stock + $orderItem->quantity;
        $product->save();
    }

    private function restoreCancelledComplementQuantity(OrderProductComplement $orderItem): void
    {
        $product = ProductComplement::find($orderItem->product_complement_id);
        $product->stock = $product->stock + $orderItem->quantity;
        $product->save();
    }
}
