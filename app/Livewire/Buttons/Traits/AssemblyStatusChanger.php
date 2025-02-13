<?php

namespace App\Livewire\Buttons\Traits;

use App\Models\ProductComplement;
use App\Models\ProductSparePart;
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

        // Complements and spare parts cannot be assembled
        if (is_a($this->product, ProductComplement::class) || is_a($this->product, ProductSparePart::class)) {
            return false;
        }

        // For variants, check if parent can be assembled
        if (is_a($this->product, ProductVariant::class)) {
            return $this->product->product->can_be_assembled ? true : false;
        }

        return $this->product->can_be_assembled ? true : false;
    }
}
