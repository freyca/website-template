<?php

declare(strict_types=1);

namespace App\Livewire\Buttons\Traits;

use App\Models\ProductVariant;
use Livewire\Attributes\On;

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
