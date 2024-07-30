<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product;

use App\DTO\FilterDTO;
use Illuminate\Database\Eloquent\Collection;

interface BaseProductRepositoryInterface
{
    public function getAll(): Collection;

    public function featured(): Collection;

    public function filter(FilterDTO $filters): Collection;
}
