<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Models\ProductVariant;
use App\Models\User;
use App\Repositories\Database\Order\Product\OrderProductRepositoryInterface;
use App\Repositories\Database\Order\ProductComplement\OrderProductComplementRepositoryInterface;
use App\Repositories\Database\Order\ProductSparePart\OrderProductSparePartRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;

class OrderBuilder
{
    private Order $order;

    private Cart $cart;

    private ?User $user;

    private PaymentMethod $payment_method;

    private Address $shipping_address;

    private Address $billing_address;

    private string $order_details;

    public function __construct(
        private readonly OrderProductRepositoryInterface $orderProductRepository,
        private readonly OrderProductComplementRepositoryInterface $orderProductComplementRepository,
        private readonly OrderProductSparePartRepositoryInterface $orderProductSparePartRepository,
    ) {}

    public function build(AddressBuilder $addressBuilder)
    {
        $this->cart = app(Cart::class);

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
        $this->order = Order::create([
            'purchase_cost' => (float) $this->cart->getTotalCost(),
            'payment_method' => $this->payment_method,
            'status' => OrderStatus::PaymentPending,
            'user_id' => $this->user ? $this->user->id : null,
            'shipping_address_id' => $this->shipping_address->id,
            'billing_address_id' => $this->billing_address->id,
            'order_details' => $this->order_details,
        ]);
    }

    private function saveOrderProducts(): void
    {
        /**
         * @var Cart
         */
        $cart = app(Cart::class);

        $CartProducts = $cart->getCart();

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
                is_a($product, Product::class) || is_a($product, ProductVariant::class) => $this->orderProductRepository->save($this->order, $productData),
                is_a($product, ProductComplement::class) => $this->orderProductComplementRepository->save($this->order, $productData),
                is_a($product, ProductSparePart::class) => $this->orderProductSparePartRepository->save($this->order, $productData),
                default => throw (new Exception('Unknown Product Type'))
            };
        }
    }
}
