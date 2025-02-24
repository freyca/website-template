<?php

namespace App\Repositories\ProductsWithDiscountPerPurchase;

use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionProductsWithDiscountPerPurchase implements ProductsWithDiscountPerPurchaseInterface
{
    const SESSION = 'apply_discount_products';

    public function __construct()
    {
        if (! Session::has(self::SESSION)) {
            Session::put(
                self::SESSION,
                collect([
                    'purchased' => collect(),
                    'in_cart' => collect(),
                ])
            );
        }
    }

    /**
     * After a user has purchased an item, call function with force
     * parameter so it refreshes all purchased items so discounts can
     * be applied
     */
    public function savePurchasedProducts(bool $force = false): void
    {
        $user = $this->validateUserLoggedIn();

        if ($user === null) {
            return;
        }

        $apply_discount_products = $this->getDiscountProducts();
        $purchased = $apply_discount_products->get('purchased');
        $in_cart = $apply_discount_products->get('in_cart');

        /**
         * Avoid to repeat logic every time function is called by middlewares
         * unless we ask for force
         */
        if ($purchased->count() > 0 && $force === false) {
            return;
        }

        $orders = $user->orders;

        foreach ($orders as $order) {
            $order_products = $order->orderProducts;

            foreach ($order_products as $order_product) {
                $purchased->push($order_product->product->ean13);
            }
        }

        $this->updateDiscountProducts($purchased, $in_cart);

        if ($force === true) {
            $this->cleanCartItems();
        }
    }

    public function addCartItem(int $ean13): void
    {
        $apply_discount_products = $this->getDiscountProducts();
        $purchased = $apply_discount_products->get('purchased');
        $in_cart = $apply_discount_products->get('in_cart');

        if ($in_cart->contains($ean13)) {
            return;
        }

        $in_cart->push($ean13);

        $this->updateDiscountProducts($purchased, $in_cart);
    }

    public function deleteCartItem(int $ean13): void
    {
        $apply_discount_products = $this->getDiscountProducts();
        $purchased = $apply_discount_products->get('purchased');
        $in_cart = $apply_discount_products->get('in_cart');

        $item_key = $in_cart->search($ean13);

        if ($item_key === false) {
            return;
        }

        $in_cart->forget($item_key);

        $this->updateDiscountProducts($purchased, $in_cart);
    }

    public function hasItemToOfferDiscount(ProductComplement|ProductSparePart $product): bool
    {
        $apply_discount_products = $this->getDiscountProducts();
        $purchased = $apply_discount_products->get('purchased');
        $in_cart = $apply_discount_products->get('in_cart');

        $offers_discounts = $product->products;

        foreach ($offers_discounts as $product) {
            if ($purchased->contains($product->ean13)) {
                return true;
            }

            if ($in_cart->contains($product->ean13)) {
                return true;
            }
        }

        return false;
    }

    private function cleanCartItems(): void
    {
        $apply_discount_products = $this->getDiscountProducts();
        $purchased = $apply_discount_products->get('purchased');
        $in_cart = collect();

        $this->updateDiscountProducts($purchased, $in_cart);
    }

    /**
     * @return Collection<Collection<string>, Collection<string>>
     */
    private function getDiscountProducts(): Collection
    {
        return Session::get(self::SESSION);
    }

    /**
     * @param  Collection<string>  $purchased
     * @param  Collection<string>  $in_cart
     */
    private function updateDiscountProducts(Collection $purchased, Collection $in_cart): void
    {
        Session::put(
            self::SESSION,
            collect([
                'purchased' => $purchased,
                'in_cart' => $in_cart,
            ])
        );
    }

    private function validateUserLoggedIn(): ?User
    {
        /** @var ?\App\Models\User */
        $user = Auth::user();

        return $user;
    }
}
