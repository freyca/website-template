<?php

declare(strict_types=1);

namespace App\Livewire\Cart;

use App\Models\BaseProduct;
use App\Models\ProductVariant;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCard extends Component
{
    public BaseProduct $product;

    public BaseProduct $parent;

    public bool $assembly_status;

    public string $path;

    #[On('refresh-cart')]
    public function render(): View
    {
        $this->setProductPath();
        $this->setProductParent();

        return view('livewire.cart.product-card');
    }

    private function setProductPath(): void
    {
        $this->path = match (true) {
            get_class($this->product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
            get_class($this->product) === 'App\Models\ProductComplement' => '/complemento',
            default => '/producto',
        };
    }

    private function setProductParent(): void
    {
        if (is_a($this->product, ProductVariant::class) && isset($this->product->product)) {
            $this->parent = $this->product->product;
        }
    }
}
