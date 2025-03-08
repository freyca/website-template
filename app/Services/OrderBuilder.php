<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Address;
use App\Models\BaseProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Repositories\Database\Order\Order\OrderRepositoryInterface;
use App\Repositories\Database\Order\Product\OrderProductRepositoryInterface;
use Illuminate\Support\Arr;

class OrderBuilder
{
    private Order $order;

    private ?User $user;

    private PaymentMethod $payment_method;

    private Address $shipping_address;

    private Address $billing_address;

    private string $order_details;

    public function __construct(
        private readonly Cart $cart,
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly OrderProductRepositoryInterface $orderProductRepository,
    ) {}

    public function build(AddressBuilder $addressBuilder): void
    {
        $this->user = $addressBuilder->user();
        $this->payment_method = $addressBuilder->paymentMethod();
        $this->shipping_address = $addressBuilder->shippingAddress();
        $this->billing_address = $addressBuilder->billingAddress();
        $this->order_details = $addressBuilder->orderDetails();

        $this->buildOrder();
        $this->saveOrderProducts();
    }

    public function order(): Order
    {
        return $this->order;
    }

    private function buildOrder(): void
    {
        $this->order = $this->orderRepository->create(
            purchase_cost: (float) $this->cart->getTotalCost(),
            payment_method: $this->payment_method,
            status: OrderStatus::PaymentPending,
            user: $this->user ? $this->user : null,
            shipping_address: $this->shipping_address,
            billing_address: $this->billing_address,
            order_details: $this->order_details,
        );
    }

    private function saveOrderProducts(): void
    {
        $CartProducts = $this->cart->getCart();

        foreach ($CartProducts as $cartProduct) {
            /** @var BaseProduct */
            $product = Arr::get($cartProduct, 'product');

            $product_data = new OrderProduct([
                'orderable_id' => $this->getProductId($product),
                'orderable_type' => get_class($product),
                'product_variant_id' => $this->getProductVariantId($product),
                'price' => $this->getProductPrice($product),
                'assembly_price' => $this->getAssemblyPrice($product),
                'quantity' => Arr::get($cartProduct, 'quantity'),
            ]);

            $this->orderProductRepository->save($this->order, $product_data);
        }
    }

    private function getProductId(BaseProduct $product): int
    {
        if (is_a($product, ProductVariant::class)) {
            return $product->product_id;
        }

        return $product->id;
    }

    private function getProductVariantId(BaseProduct $product): ?int
    {
        if (is_a($product, ProductVariant::class)) {
            return $product->id;
        }

        return null;
    }

    private function getProductPrice(BaseProduct $product): float
    {
        return $product->price_with_discount ? $product->price_with_discount : $product->price;
    }

    private function getAssemblyPrice(BaseProduct $product): ?float
    {
        return match (true) {
            is_a($product, ProductVariant::class) => $product->product?->assembly_price,
            is_a($product, Product::class) => $product->assembly_price,
            default => null
        };
    }
}
