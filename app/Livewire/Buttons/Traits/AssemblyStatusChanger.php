<?php

namespace App\Livewire\Buttons\Traits;

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
        return isset($this->assembly_status) ? $this->assembly_status : true;
    }
}
