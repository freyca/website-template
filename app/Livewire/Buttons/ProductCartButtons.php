<?php

namespace App\Livewire\Buttons;

use App\Models\BaseProduct;
use App\Models\ProductVariant;
use Illuminate\Support\Collection;
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
    ) {
        $this->product = $product;
        $this->variants = $variants;

        $this->setAssemblyStatus();
        $this->setMandatoryAssemblyStatus();

        $this->maybeSetVariant();
    }

    #[On('refresh-cart')]
    public function render()
    {
        return view('livewire.buttons.product-cart-buttons');
    }

    private function setAssemblyStatus(): void
    {
        if (is_a($this->product, ProductVariant::class)) {
            $this->can_be_assembled = $this->product->product->can_be_assembled;
        }

        $this->can_be_assembled = boolval($this->product->can_be_assembled);
    }

    private function setMandatoryAssemblyStatus(): void
    {
        if (is_a($this->product, ProductVariant::class)) {
            $this->mandatory_assembly = $this->product->product->mandatory_assembly;
        }

        $this->mandatory_assembly = boolval($this->product->mandatory_assembly);
    }

    private function maybeSetVariant(): void
    {
        if ($this->variants->count()) {
            $this->product = $this->variants->first();
        }
    }
}
