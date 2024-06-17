<?php

declare(strict_types=1);

namespace App\Repositories\Product;

use Illuminate\Database\Eloquent\Collection;

interface BaseProductRepositoryInterface
{
    public function getAll(): Collection;

    public function featured(): Collection;
}
