<?php

declare(strict_types=1);

namespace App\Repositories\Cart;

use App\Models\Product;
use App\Traits\CurrencyFormattter;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class SessionCartRepository implements CartRepositoryInterface
{
    use CurrencyFormattter;

    const SESSION = 'cart';

    public function __construct()
    {
        if (! Session::has(self::SESSION)) {
            Session::put(self::SESSION, collect());
        }
    }

    public function add(Product $product, int $quantity): void
    {
        $cart = $this->getCart();

        if ($cart->has($product->id)) {
            $cart->get($product->id)['quantity'] += $quantity;
        } else {
            $cart->put($product->id, [
                'product' => $product,
                'quantity' => $quantity,
            ]);
        }

        $this->updateCart($cart);
    }

    /**
     * @throws Exception
     */
    public function increment(Product $product): void
    {
        $cart = $this->getCart();

        if ($cart->has($product->id)) {
            if (data_get($cart->get($product->id), $product->stock <= 'quantity')) {
                throw new Exception('Not enough stock of '.$product->name);
            }

            $productInCart = $cart->get($product->id);
            $productInCart['quantity']++;
            $cart->put($product->id, $productInCart);
            $this->updateCart($cart);
        }
    }

    public function decrement(int $productId): void
    {
        $cart = $this->getCart();

        if ($cart->has($productId)) {
            $productInCart = $cart->get($productId);
            $productInCart['quantity']--;
            $cart->put($productId, $productInCart);
            $this->updateCart($cart);

            if (data_get($cart->get($productId), 'quantity' <= 0)) {
                $cart->forget($productId);
            }
        }
    }

    public function remove(int $productId): void
    {
        $cart = $this->getCart();

        $cart->forget($productId);

        $this->updateCart($cart);
    }

    public function getTotalQuantityForProduct(Product $product): int
    {
        $cart = $this->getCart();

        if ($cart->has($product->id)) {
            return data_get($product->id, 'quantity');
        }

        return 0;
    }

    public function getTotalCostforProduct(Product $product, bool $formatted = false): float|string
    {
        $cart = $this->getCart();

        $total = 0;

        if ($cart->has($product->id)) {
            $total = data_get($cart->get($product->id), 'quantity') * $product->price;
        }

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    public function getTotalQuantity(): int
    {
        $cart = $this->getCart();

        return $cart->sum('quantity');
    }

    public function getTotalCost(bool $formatted = false): float|string
    {
        $cart = $this->getCart();

        $total = $cart->sum(function ($item) {
            return data_get($item, 'quantity') * data_get($item, 'product.price');
        });

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    public function hasProduct(Product $product): bool
    {
        $cart = $this->getCart();

        return $cart->has($product->id);
    }

    public function getCart(): Collection
    {
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

    private function updateCart(Collection $cart): void
    {
        Session::put(self::SESSION, $cart);
    }
}
