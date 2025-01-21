<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\BaseProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Address;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Database\Order\Product\OrderProductRepositoryInterface;
use App\Repositories\Database\Order\ProductComplement\OrderProductComplementRepositoryInterface;
use App\Repositories\Database\Order\ProductSparePart\OrderProductSparePartRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

final class Cart
{
    public function __construct(
        private readonly CartRepositoryInterface $repository,
        private readonly OrderProductRepositoryInterface $orderProductRepository,
        private readonly OrderProductComplementRepositoryInterface $orderProductComplementRepository,
        private readonly OrderProductSparePartRepositoryInterface $orderProductSparePartRepository,
    ) {}

    public function add(BaseProduct $product, int $quantity): void
    {
        $this->repository->add($product, $quantity);
    }

    /**
     * @throws \Exception
     */
    public function increment(BaseProduct $product): bool
    {
        try {
            $this->repository->increment($product);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function decrement(BaseProduct $product): void
    {
        $this->repository->decrement($product);
    }

    public function remove(BaseProduct $product): void
    {
        $this->repository->remove($product);
    }

    public function getTotalQuantityForProduct(BaseProduct $product): int
    {
        return $this->repository->getTotalQuantityForProduct($product);
    }

    public function getTotalCostforProduct(BaseProduct $product, bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostforProduct($product, $formatted);
    }

    public function getTotalCostforProductWithoutDiscount(BaseProduct $product, bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostforProductWithoutDiscount($product, $formatted);
    }

    public function getTotalQuantity(): int
    {
        return $this->repository->getTotalQuantity();
    }

    public function getTotalCost(bool $formatted = false): float|string
    {
        return $this->repository->getTotalCost($formatted);
    }

    public function getTotalCostWithoutTaxes(bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostWithoutTaxes($formatted);
    }

    public function getTotalDiscount(bool $formatted = false): float|string
    {
        return $this->repository->getTotalDiscount($formatted);
    }

    public function getTotalCostWithoutDiscount(bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostWithoutDiscount($formatted);
    }

    public function hasProduct(BaseProduct $product): bool
    {
        return $this->repository->hasProduct($product);
    }

    /**
     * @return Collection<string, array<string, BaseProduct|int>>
     */
    public function getCart(): Collection
    {
        return $this->repository->getCart();
    }

    public function isEmpty(): bool
    {
        return $this->repository->isEmpty();
    }

    public function clear(): void
    {
        $this->repository->clear();
    }

    public function buildOrder(PaymentMethod $paymentMethod, User $user, Address $Address): Order
    {
        $order = new Order;
        $order->purchase_cost = (float) $this->getTotalCost();
        $order->payment_method = $paymentMethod;
        $order->status = OrderStatus::PaymentPending;
        $order->user_id = $user->id;
        $order->address_id = $Address->id;

        $order->save();

        /** @var Order */
        $order = $order->fresh();

        $this->saveOrderProducts($order);

        /** @var Order */
        return $order;
    }

    private function saveOrderProducts(Order $order): void
    {
        $CartProducts = $this->getCart();

        foreach ($CartProducts as $cartProduct) {
            $quantity = Arr::get($cartProduct, 'quantity');
            /** @var BaseProduct */
            $product = Arr::get($cartProduct, 'product');

            $product_id = $product->id;
            $product_variant_id = null;
            $price = $product->price_with_discount ? $product->price_with_discount : $product->price;

            if (is_a($product, ProductVariant::class)) {
                $product_variant_id = $product->id;
                $product_id = $product->product_id;
            }

            $productData = [
                'product_id' => $product_id,
                'product_variant_id' => $product_variant_id,
                'price' => $price,
                'quantity' => $quantity,
            ];

            match (true) {
                is_a($product, Product::class) || is_a($product, ProductVariant::class) => $this->orderProductRepository->save($order, $productData),
                is_a($product, ProductComplement::class) => $this->orderProductComplementRepository->save($order, $productData),
                is_a($product, ProductSparePart::class) => $this->orderProductSparePartRepository->save($order, $productData),
                default => throw (new Exception('Unknown Product Type'))
            };
        }
    }
}
