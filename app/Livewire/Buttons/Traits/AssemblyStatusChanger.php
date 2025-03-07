<?php

declare(strict_types=1);

namespace App\Livewire\Buttons\Traits;

use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Attributes\On;

trait AssemblyStatusChanger
{
    public bool $assembly_status;

    #[On('assembly-status-changed')]
    public function assemblyStatus(bool $assembly_status): void
    {
        $this->assembly_status = $assembly_status;

        $this->dispatch('refresh-cart');
    }

    public function getAssemblyStatus(): bool
    {
        // If isset by user, return status
        if (isset($this->assembly_status)) {
            return $this->assembly_status;
        }

        return match (true) {
            is_a($this->product, ProductVariant::class) => isset($this->product->product->can_be_assembled) ? $this->product->product->can_be_assembled : false,
            is_a($this->product, Product::class) => $this->product->can_be_assembled ? true : false,
            default => false,
        };
    }
}
