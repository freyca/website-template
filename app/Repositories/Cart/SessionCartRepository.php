<?php

declare(strict_types=1);

namespace App\Repositories\Cart;

use App\Models\BaseProduct;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Models\ProductVariant;
use App\Repositories\ProductsWithDiscountPerPurchase\ProductsWithDiscountPerPurchaseInterface;
use App\Traits\CurrencyFormatter;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class SessionCartRepository implements CartRepositoryInterface
{
    use CurrencyFormatter;

    const SESSION = 'cart';

    public function __construct(
        private readonly ProductsWithDiscountPerPurchaseInterface $discount_products,
    ) {
        if (! Session::has(self::SESSION)) {
            Session::put(self::SESSION, collect());
        }
    }

    public function add(BaseProduct $product, int $quantity, bool $assemble): bool
    {
        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assemble);

        // we do not need to check decrement since if the sum is less than 0
        // we delete product from cart
        if ($quantity > 0 && ! $this->canBeIncremented($product)) {
            throw new Exception('Product cannot be incremented');
        }

        // Cart does not has the product, we simply add it
        if (! $cart->has($cart_product_key)) {
            $cart->put($cart_product_key, [
                'product' => $product,
                'quantity' => $quantity,
                'assemble' => $assemble,
            ]);

            $this->updateCart($cart);
            $this->addProductToDiscountable($product);

            return true;
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
            $this->addProductToDiscountable($product);

            return true;
        }

        // Cart has the product in same assemble state
        $old_quantity = data_get($session_product, 'quantity');
        $new_quantity = $old_quantity + $quantity;

        if ($new_quantity <= 0) {
            $this->remove($product, $assemble);
            $this->removeProductFromDiscountable($product);

            return false;
        }

        data_set($session_product, 'quantity', $new_quantity);
        $cart->put($cart_product_key, $session_product);

        $this->updateCart($cart);

        return true;
    }

    public function remove(BaseProduct $product, bool $assemble): void
    {
        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assemble);

        $cart->forget($cart_product_key);

        $this->updateCart($cart);
        $this->removeProductFromDiscountable($product);
    }

    public function hasProduct(BaseProduct $product, bool $assembly_status): bool
    {
        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assembly_status);

        return $cart->has($cart_product_key);
    }

    /**
     * @return Collection<string, array<string, BaseProduct|int|bool>>
     */
    public function getCart(): Collection
    {
        /** @var Collection<string, array<string, BaseProduct|int|bool>> */
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
     * @param  Collection<string, array<string, BaseProduct|int|bool>>  $cart
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

        if (
            (is_a($product, ProductComplement::class) || is_a($product, ProductSparePart::class))
            && $this->discount_products->hasItemToOfferDiscount($product)
        ) {
            $price = $product->price_when_user_owns_product;
        }

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

            return $this->getTotalCostforProductWithoutDiscount($product, $assemble) - $this->getTotalCostforProduct($product, $assemble); // @phpstan-ignore-line
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
        $parent = is_a($product, ProductVariant::class) ? $product->product : $product;

        if (isset($parent->can_be_assembled) && $parent->can_be_assembled !== true) {
            return strval($product->ean13);
        }

        $assemble = $assemble ? 'assemble' : 'noAssemble';

        return strval($product->ean13).'+'.$assemble;
    }

    private function calculateCostForProduct(BaseProduct $product, bool $assemble, float $price, bool $formatted = false): float|string
    {
        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assemble);

        $quantity = data_get($cart->get($cart_product_key), 'quantity');

        $total = 0;
        if (! $cart->has($cart_product_key)) {
            return $formatted ? $this->formatCurrency($total) : $total;
        }

        $assembly_cost = 0;
        if (is_a($product, ProductVariant::class) || is_a($product, Product::class)) {
            $assembly_cost = $this->calculateAssemblyCost($product, $assemble);
        }

        $total = ($quantity * $price) + $assembly_cost;

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    private function calculateAssemblyCost(Product|ProductVariant $product, bool $assemble): float
    {
        if ($assemble === false) {
            return floatval(0);
        }

        $cart = $this->getCart();
        $cart_product_key = $this->getProductKey($product, $assemble);

        $assembly_price = is_a($product, ProductVariant::class) ? $product->product->assembly_price : $product->assembly_price;
        $quantity = data_get($cart->get($cart_product_key), 'quantity');

        return $assembly_price * $quantity;
    }

    public function canBeIncremented(BaseProduct $product): bool
    {
        $cart = $this->getCart();

        // If product cannot be assembled we only have to query cart once
        if (isset($product->can_be_assembled) && ! $product->can_be_assembled) {
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
            $quantity1 = intval(data_get($cart->get($key1), 'quantity'));
        }

        if ($cart->has($key2)) {
            $quantity2 = intval(data_get($cart->get($key2), 'quantity'));
        }

        return ($quantity1 + $quantity2) < $product->stock;
    }

    /**
     * Only purchasing a product has discounts in Complements and Spare Parts
     * If Product is a Variant, since complements and SpareParts are associated
     * to parent, we use parent id
     */
    private function addProductToDiscountable(BaseProduct $product): void
    {
        match (true) {
            is_a($product, Product::class) => $this->discount_products->addCartItem($product->ean13),
            is_a($product, ProductVariant::class) => $this->discount_products->addCartItem($product->product->ean13),
            default => true,
        };
    }

    private function removeProductFromDiscountable(BaseProduct $product): void
    {
        match (true) {
            is_a($product, Product::class) => $this->discount_products->deleteCartItem($product->ean13),
            is_a($product, ProductVariant::class) => $this->discount_products->deleteCartItem($product->product->ean13),
            default => true,
        };
    }
}
