<?php

namespace Database\Seeders;

use App\Enums\AddressType;
use App\Enums\Role;
use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductFeature;
use App\Models\ProductFeatureValue;
use App\Models\ProductSparePart;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // For convenience, all categories and products has the same image
        // We hardcode it here and, if it not exists, we create it
        $imageName = 'sample-image.png';
        $this->generateImage(config('custom.product-image-storage'), $imageName);
        $this->generateImage(config('custom.category-image-storage'), $imageName);

        ProductFeature::factory(10)
            ->has(
                ProductFeatureValue::factory(2)
            )->create();

        Category::factory(5)
            ->has(
                Product::factory(10)
                    ->has(
                        ProductSparePart::factory(1)
                            ->hasAttached(ProductFeatureValue::find(rand(1, 10)))
                    )->has(
                        ProductComplement::factory(1)
                            ->hasAttached(ProductFeatureValue::find(rand(1, 10)))
                    )->hasAttached(ProductFeatureValue::find(rand(1, 10)))
            )
            ->create();

        // Products with variations
        Product::factory(5)
            ->has(
                ProductVariant::factory(2)
                    ->hasAttached(ProductFeatureValue::find(rand(1, 10)))
            )
            ->create();

        // Create users and attach its orders
        for ($counter = 0; $counter < 10; $counter++) {
            $user = User::factory()->create();

            Address::factory(5)->for($user)->create();

            Order::factory(5, [
                'shipping_address_id' => $user->addresses->first()->id,
            ])
                ->for($user)
                ->has(OrderProduct::factory(2))
                ->create();
        }

        // Creates an admin user if not exists
        if (User::where('email', 'fran@gmail.com')->first() === null) {
            User::create([
                'name' => 'Fran',
                'surname' => 'Rey Castedo',
                'email' => 'fran@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => Role::Admin,
            ]);

            Address::create([
                'user_id' => User::where('email', 'fran@gmail.com')->first()->id,
                'address_type' => AddressType::Shipping,
                'name' => 'Francisco',
                'surname' => 'Rey Castedo',
                'email' => 'franreycastedo@gmail.es',
                'financial_number' => '00000000F',
                'phone' => 617547428,
                'address' => 'Lamas de prado 86',
                'city' => 'Lugo',
                'state' => 'Galiza',
                'zip_code' => 27004,
                'country' => 'Galiza',
            ]);
        }
    }

    private function generateImage(string $path, string $imageName): void
    {
        $relativePath = Str::replace(public_path('/storage'), '', $path);

        if (Storage::disk('public')->exists($relativePath.'/'.$imageName)) {
            return;
        }

        $newImage = fake()->image($path);
        $imageRelativePath = Str::replace(public_path('/storage'), '', $newImage);

        Storage::disk('public')->move($imageRelativePath, $relativePath.'/'.$imageName);
    }
}
