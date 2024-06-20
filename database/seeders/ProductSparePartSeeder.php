<?php

namespace Database\Seeders;

use App\Models\ProductFeature;
use App\Models\ProductSparePart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSparePartSeeder extends Seeder
{
    public function run(): void
    {
        ProductSparePart::factory(10)
            ->hasAttached(ProductFeature::find(rand(1, 10)))
            ->create();
    }
}
