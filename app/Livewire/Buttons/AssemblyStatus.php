<?php

namespace App\Livewire\Buttons;

use App\Livewire\Buttons\Traits\ProductVariantChanger;
use App\Models\BaseProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\View\View;
use Livewire\Component;

class AssemblyStatus extends Component
{
    use ProductVariantChanger;

    public BaseProduct $product;

    public string $assembly_price;

    public bool $mandatory_assembly;

    public bool $assembly_status = true;

    public function toggleAssemble(): void
    {
        $this->assembly_status = ! $this->assembly_status;

        $this->dispatch('assembly-status-changed', $this->assembly_status);
    }

    public function render(): View
    {
        if (! isset($this->assembly_price)) {
            $this->setAssemblyPrice();
        }

        return view('livewire.buttons.assembly-status');
    }

    private function setAssemblyPrice(): void
    {
        if (is_a($this->product, ProductVariant::class)) {
            $this->assembly_price = $this->product->product->getFormattedAssemblyPrice();

            return;
        }

        if (is_a($this->product, Product::class)) {
            $this->assembly_price = $this->product->getFormattedAssemblyPrice();

            return;
        }

        $this->assembly_price = '0';
    }
}
