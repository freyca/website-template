<?php

namespace Database\Seeders;

use App\Models\ProductComplement;
use App\Models\ProductFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductComplementSeeder extends Seeder
{
    public function run(): void
    {
        ProductComplement::factory(10)
            ->hasAttached(ProductFeature::find(rand(1, 10)))
            ->create();
    }
}
