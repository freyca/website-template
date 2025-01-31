<?php

namespace App\Livewire\Buttons\Traits;

use Livewire\Attributes\On;
use App\Models\ProductVariant;

trait ProductVariantChanger
{
    public int $variant_id;

    #[On('variant-selection-changed')]
    public function variantChanged(int $variant_id): void
    {
        /**
         * @var ProductVariant
         */
        $variant = ProductVariant::find($variant_id);

        $this->product = $variant;
    }
}
