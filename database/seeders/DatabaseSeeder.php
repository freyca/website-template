<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $productImage = $this->generateImage(config('custom.product-image-storage'));
        $categoryImage = $this->generateImage(config('custom.category-image-storage'));

        User::factory(10)->create();

        User::all()->each(function ($user) {
            $user->metadata()->create([
                'user_id' => $user->id,
                'address' => fake()->address(),
                'city' => fake()->city(),
                'postal_code' => fake()->numberBetween(10000, 99999),

            ]);
        });

        // Creates an admin user if not exists
        if (User::where('email', 'fran@gmail.com')->first() === null) {
            User::create([
                'name' => fake()->name(),
                'email' => 'fran@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => Roles::admin,
            ]);
        }

        Category::factory(5)->create([
            'big_image' => $categoryImage,
            'small_image' => $categoryImage,
        ]);

        Product::factory(40)->create([
            'main_image' => $productImage,
            'images' => $this->generateImageArray($productImage),
        ]);

        ProductSparePart::factory(20)->create([
            'main_image' => $productImage,
            'images' => $this->generateImageArray($productImage),
        ]);

        ProductComplement::factory(20)->create([
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

        // Populate the pivot table product_product_spare_part
        $productSpareParts = ProductSparePart::all();
        Product::all()->each(function ($product) use ($productSpareParts) {
            $product->spareParts()->attach(
                $productSpareParts->random(rand(3, 5))->pluck('id')->toArray()
            );
        });

        // Populate the pivot table product_product_complement
        $productComplements = ProductComplement::all();
        Product::all()->each(function ($product) use ($productComplements) {
            $product->complements()->attach(
                $productComplements->random(rand(3, 5))->pluck('id')->toArray()
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
