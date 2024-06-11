<?php

namespace App\Traits;

trait CartActions
{
    public function addProductTocart(): void
    {
        $productId = request()->integer('product_id');
        $quantity = request()->integer('quantity', 1);

        $product = $this->repository->find($productId);
        $this->cart->add($product, $quantity);
    }

    public function incrementProductQuantity(): void
    {
        $productId = request()->integer('product_id');
        $product = $this->repository->find($productId);

        try {
            $this->cart->increment($product);
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }
    }

    public function decrementProductQuantity(): void
    {
        $productId = request()->integer('product_id');
        $this->cart->decrement($productId);
    }

    public function removeProduct(): void
    {
        $productId = request()->integer('product_id');
        $this->cart->remove($productId);
    }

    public function clearCart(): void
    {
        $this->cart->clear();
    }
}
