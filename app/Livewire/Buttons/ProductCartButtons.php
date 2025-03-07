<?php

declare(strict_types=1);

namespace App\Livewire\Buttons;

use App\Models\BaseProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCartButtons extends Component
{
    public BaseProduct $product;

    public Collection $variants;

    public bool $can_be_assembled;

    public bool $mandatory_assembly;

    public function mount(
        BaseProduct $product,
        Collection $variants,
    ): void {
        $this->product = $product;
        $this->variants = $variants;

        $this->setAssemblyStatus();
        $this->setMandatoryAssemblyStatus();

        $this->maybeSetVariant();
    }

    #[On('refresh-cart')]
    public function render(): View
    {
        return view('livewire.buttons.product-cart-buttons');
    }

    private function setAssemblyStatus(): void
    {
        $this->can_be_assembled = match (true) {
            is_a($this->product, ProductVariant::class) => isset($this->product->product->can_be_assembled) ? $this->product->product->can_be_assembled : false,
            is_a($this->product, Product::class) => $this->product->can_be_assembled,
            default => false,
        };
    }

    private function setMandatoryAssemblyStatus(): void
    {
        $this->mandatory_assembly = match (true) {
            is_a($this->product, ProductVariant::class) => isset($this->product->product->mandatory_assembly) ? $this->product->product->mandatory_assembly : false,
            is_a($this->product, Product::class) => $this->product->mandatory_assembly,
            default => false,
        };
    }

    private function maybeSetVariant(): void
    {
        if ($this->variants->count()) {
            $this->product = $this->variants->first();
        }
    }
}
