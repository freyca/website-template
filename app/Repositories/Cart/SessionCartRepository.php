<?php

declare(strict_types=1);

namespace App\Repositories\Cart;

use App\Models\BaseProduct;
use App\Traits\CurrencyFormatter;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class SessionCartRepository implements CartRepositoryInterface
{
    use CurrencyFormatter;

    const SESSION = 'cart';

    public function __construct()
    {
        if (! Session::has(self::SESSION)) {
            Session::put(self::SESSION, collect());
        }
    }

    public function add(BaseProduct $product, int $quantity): void
    {
        $cart = $this->getCart();

        if ($cart->has($product->name)) {
            $sessionProduct = $cart->get($product->name);
            $oldQuantity = data_get($sessionProduct, 'quantity');
            data_set($sessionProduct, 'quantity', $oldQuantity + $quantity);
            $cart->put($product->name, $sessionProduct);
        } else {
            $cart->put($product->name, [
                'product' => $product,
                'quantity' => $quantity,
            ]);
        }

        $this->updateCart($cart);
    }

    /**
     * @throws Exception
     */
    public function increment(BaseProduct $product): void
    {
        $cart = $this->getCart();

        if ($cart->has($product->name)) {
            if (data_get($cart->get($product->name), 'quantity') <= $product->stock) {
                throw new Exception('Not enough stock of '.$product->name);
            }

            $productInCart = $cart->get($product->name);
            $oldQuantity = data_get($productInCart, 'quantity');
            data_set($productInCart, 'quantity', $oldQuantity + 1);
            $cart->put($product->name, $productInCart);
            $this->updateCart($cart);
        }
    }

    public function decrement(BaseProduct $product): void
    {
        $cart = $this->getCart();

        if ($cart->has($product->name)) {
            $productInCart = $cart->get($product->name);
            $oldQuantity = data_get($productInCart, 'quantity');
            data_set($productInCart, 'quantity', $oldQuantity - 1);
            $cart->put($product->name, $productInCart);
            $this->updateCart($cart);

            if (data_get($cart->get($product->name), 'quantity') <= 0) {
                $cart->forget($product->name);
            }
        }
    }

    public function remove(BaseProduct $product): void
    {
        $cart = $this->getCart();

        $cart->forget($product->name);

        $this->updateCart($cart);
    }

    public function getTotalQuantityForProduct(BaseProduct $product): int
    {
        $cart = $this->getCart();

        if ($cart->has($product->name)) {
            /** @var int */
            return data_get($product->name, 'quantity');
        }

        return 0;
    }

    public function getTotalCostforProduct(BaseProduct $product, bool $formatted = false): float|string
    {
        $cart = $this->getCart();

        $total = 0;

        if ($cart->has($product->name)) {
            $total = data_get($cart->get($product->name), 'quantity') * $product->price;
        }

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    public function getTotalQuantity(): int
    {
        $cart = $this->getCart();

        /** @var int */
        return $cart->sum('quantity');
    }

    public function getTotalCost(bool $formatted = false): float|string
    {
        $cart = $this->getCart();

        /** @var float */
        $total = $cart->sum(function ($item) {
            return data_get($item, 'quantity') * data_get($item, 'product.price');
        });

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    public function hasProduct(BaseProduct $product): bool
    {
        $cart = $this->getCart();

        return $cart->has($product->name);
    }

    /**
     * @return Collection<string, array<string, BaseProduct|int>>
     */
    public function getCart(): Collection
    {
        /** @var Collection<string, array<string, BaseProduct|int>> */
        return Session::get(self::SESSION);
    }

    public function isEmpty(): bool
    {
        return $this->getTotalQuantity() === 0;
    }

    public function clear(): void
    {
        Session::forget(self::SESSION);
    }

    /**
     * @param  Collection<string, array<string, BaseProduct|int>>  $cart
     */
    private function updateCart(Collection $cart): void
    {
        Session::put(self::SESSION, $cart);
    }
}
