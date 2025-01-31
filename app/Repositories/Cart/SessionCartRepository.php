<?php

declare(strict_types=1);

namespace App\Repositories\Cart;

use App\Models\BaseProduct;
use App\Models\ProductVariant;
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

    public function add(BaseProduct $product, int $quantity, bool $assemble): void
    {
        $cart = $this->getCart();
        $product = $this->cleanCartProduct($product);
        $cart_product_key = $this->getProductKey($product, $assemble);

        // we do not need to check decrement since if the sum is less than 0
        // we delete product from cart
        if ($quantity > 0 && !$this->canBeIncremented($product)) {
            throw new Exception('Product cannot be incremented');
        }

        // Cart does not has the product, we simply add it
        if (!$cart->has($cart_product_key)) {
            $cart->put($cart_product_key, [
                'product' => $product,
                'quantity' => $quantity,
                'assemble' => $assemble !== null ? $assemble : false,
            ]);

            $this->updateCart($cart);
            return;
        }

        $session_product = $cart->get($cart_product_key);

        // Cart has the product but in a different assemble state
        if (data_get($session_product, 'assemble') !== $assemble) {
            $cart->put($cart_product_key, [
                'product' => $product,
                'quantity' => $quantity,
                'assemble' => $assemble,
            ]);

            $this->updateCart($cart);
            return;
        }

        // Cart has the product in same assemble state
        $old_quantity = data_get($session_product, 'quantity');
        $new_quantity = $old_quantity + $quantity;

        if ($new_quantity <= 0) {
            $this->remove($product, $assemble);
            return;
        }

        data_set($session_product, 'quantity', $new_quantity);
        $cart->put($cart_product_key, $session_product);

        $this->updateCart($cart);
    }

    public function remove(BaseProduct $product, bool $assemble): void
    {
        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assemble);

        $cart->forget($cart_product_key);

        $this->updateCart($cart);
    }

    public function hasProduct(BaseProduct $product, bool $assembly_status): bool
    {
        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assembly_status);

        return $cart->has($cart_product_key);
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


    public function getTotalQuantity(): int
    {
        $cart = $this->getCart();

        /** @var int */
        return $cart->sum('quantity');
    }

    public function getTotalQuantityForProduct(BaseProduct $product, bool $assemble): int
    {
        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assemble);

        if ($cart->has($cart_product_key)) {
            $productInCart = $cart->get($cart_product_key);

            /** @var int */
            return data_get($productInCart, 'quantity');
        }

        return 0;
    }

    public function getTotalCostforProduct(BaseProduct $product, bool $assemble, bool $formatted = false): float|string
    {
        $price = isset($product->price_with_discount) ? $product->price_with_discount : $product->price;

        return $this->calculateCostForProduct($product, $assemble, $price, $formatted);
    }

    public function getTotalCostforProductWithoutDiscount(BaseProduct $product, bool $assemble, bool $formatted = false): float|string
    {
        $price = $product->price;

        return $this->calculateCostForProduct($product, $assemble, $price, $formatted);
    }

    public function getTotalCost(bool $formatted = false): float|string
    {
        $cart = $this->getCart();

        /** @var float */
        $total = $cart->sum(function ($item) {
            /** @var BaseProduct */
            $product = data_get($item, 'product');
            $assemble = data_get($item, 'assemble');
            return $this->getTotalCostforProduct($product, $assemble);
        });

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    public function getTotalCostWithoutTaxes(bool $formatted = false): float|string
    {
        $cart = $this->getCart();

        /** @var float */
        $total = $cart->sum(function ($item) {
            /** @var BaseProduct */
            $product = data_get($item, 'product');
            $assemble = data_get($item, 'assemble');
            return $this->getTotalCostforProduct($product, $assemble);
        });

        $total_without_taxes = $total * (1 - config('custom.tax_iva'));

        return $formatted ? $this->formatCurrency($total_without_taxes) : $total_without_taxes;
    }

    public function getTotalDiscount(bool $formatted = false): float|string
    {
        $cart = $this->getCart();

        /** @var float */
        $total = $cart->sum(function ($item) {
            /** @var BaseProduct */
            $product = data_get($item, 'product');
            $assemble = data_get($item, 'assemble');
            return $this->getTotalCostforProductWithoutDiscount($product, $assemble) - $this->getTotalCostforProduct($product, $assemble);
        });

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    public function getTotalCostWithoutDiscount(bool $formatted = false): float|string
    {
        $cart = $this->getCart();

        /** @var float */
        $total = $cart->sum(function ($item) {
            /** @var BaseProduct */
            $product = data_get($item, 'product');
            $assemble = data_get($item, 'assemble');
            return $this->getTotalCostforProductWithoutDiscount($product, $assemble);
        });

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    private function getProductKey(BaseProduct $product, ?bool $assemble = null): string
    {
        $parent = $product;

        if (is_a($product, ProductVariant::class)) {
            $parent = $product->product;
        }

        if (!$parent->can_be_assembled) {
            return strval($product->ean13);
        }

        $assemble = $assemble ? 'assemble' : 'noAssemble';

        return strval($product->ean13) . '+' . $assemble;
    }

    private function cleanCartProduct(BaseProduct $product): BaseProduct
    {
        $product->meta_description = '';
        $product->short_description = '';
        $product->description = '';
        $product->images = [];

        return $product;
    }

    private function calculateCostForProduct(BaseProduct $product, bool $assemble, $price, bool $formatted = false): float|string
    {
        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assemble);

        $quantity = data_get($cart->get($cart_product_key), 'quantity');

        $total = 0;
        if ($cart->has($cart_product_key)) {
            $total = $quantity * $price + $this->calculateAssemblyCost($product, $assemble);
        }

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    private function calculateAssemblyCost(BaseProduct $product, bool $assemble)
    {
        if ($assemble === false) {
            return 0;
        }

        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assemble);

        $assembly_price = is_a($product, ProductVariant::class) ? $product->product->assembly_price : $product->assembly_price;
        $quantity = data_get($cart->get($cart_product_key), 'quantity');

        return $assembly_price * $quantity;
    }

    private function canBeIncremented(BaseProduct $product): bool
    {
        $cart = $this->getCart();

        // If product cannot be assembled we only have to query cart once
        if (!$product->can_be_assembled) {
            $quantity = 0;
            $key = $this->getProductKey($product, false);

            // If product is in cart, we set the quantity
            if ($cart->has($key)) {
                $quantity = data_get($cart->get($key), 'quantity');
            }

            return $quantity < $product->stock;
        }

        // If product can be assembled could be twice in cart
        $key1 = $this->getProductKey($product, true);
        $key2 = $this->getProductKey($product, false);

        $quantity1 = 0;
        $quantity2 = 0;

        // We search for the keys in the cart
        if ($cart->has($key1)) {
            $quantity1 = data_get($cart->get($key1), 'quantity');
        }

        if ($cart->has($key2)) {
            $quantity2 = data_get($cart->get($key2), 'quantity');
        }

        return $quantity1 + $quantity2 < $product->stock;
    }
}
