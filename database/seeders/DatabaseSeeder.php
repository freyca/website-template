<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $productImage = $this->generateImage(config('custom.product-image-storage'));
        $categoryImage = $this->generateImage(config('custom.category-image-storage'));

        User::factory(10)->create();

        Category::factory(5)->create([
            'big_image' => $categoryImage,
            'small_image' => $categoryImage,
        ]);

        Product::factory(40)->create([
            'main_image' => $productImage,
            'images' => $this->generateImageArray($productImage),
        ]);

        Order::factory(30)->create();

        // Populate the pivot table order_product
        $products = Product::all();
        Order::all()->each(function ($order) use ($products) {
            $order->products()->attach(
                $products->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }

    private function generateImage(string $path): string
    {
        return '/'.Str::ltrim((fake()->image($path)), base_path('/public'));
    }

    private function generateImageArray(string $productImage): array
    {
        $imageNumber = fake()->randomNumber(1);
        $counter = 0;
        $imageArray = [];

        while ($counter <= $imageNumber) {
            array_push($imageArray, $productImage);
            $counter++;
        }

        return $imageArray;
    }
}
