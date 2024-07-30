<?php

declare(strict_types=1);

namespace App\DTO;

class FilterDTO
{
    public int $minPrice;

    public int $maxPrice;

    public int $category;

    /**
     * @var array<int>
     */
    public array $features = [];

    /**
     * @param  array<int>  $features
     */
    public function __construct(
        int $minPrice,
        int $maxPrice,
        int $category,
        array $features,
    ) {
        $this->minPrice = intval($minPrice);
        $this->maxPrice = intval($maxPrice);
        $this->category = intval($category);

        foreach ($features as $featureId) {
            array_push($this->features, intval($featureId));
        }
    }
}
