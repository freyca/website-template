<?php

namespace Database\Seeders;

use App\Enums\AddressType;
use App\Models\Address;
use App\Models\Category;
use App\Models\Disassembly;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductSparePart;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // For convenience, all categories and products has the same image
        // We hardcode it here and, if it not exists, we create it
        $imageName = 'sample-image.png';
        $this->generateImage(config('custom.product-image-storage'), $imageName);
        $this->generateImage(config('custom.category-image-storage'), $imageName);

        // ProductFeature::factory(10)
        //    ->has(
        //        ProductFeatureValue::factory(2)
        //    )->create();

        Category::factory(3)
            ->has(
                Product::factory(5)
                    ->has(
                        Disassembly::factory(3)
                            ->has(ProductSparePart::factory(5))
                    )
                // ->has(
                //    ProductSparePart::factory(10)
                //        ->hasAttached(ProductFeatureValue::find(rand(1, 10)))
                // )->has(
                //    ProductComplement::factory(1)
                //        ->hasAttached(ProductFeatureValue::find(rand(1, 10)))
                // )->hasAttached(ProductFeatureValue::find(rand(1, 10)))
            )
            ->create();

        // Products with variations
        // Product::factory(5)
        //    ->has(
        //        ProductVariant::factory(2)
        //            ->hasAttached(ProductFeatureValue::find(rand(1, 10)))
        //    )
        //    ->has(
        //        Disassembly::factory(3)
        //            ->has(ProductSparePart::factory(5))
        //    )
        //    ->create();

        // Create customers with addresses and orders
        for ($counter = 0; $counter < 10; $counter++) {
            $user = User::factory()->customer()->create();

            Address::factory(5)->for($user)->create();

            Order::factory(5)
                ->for($user)
                ->has(OrderProduct::factory(2))
                ->create();
        }

        // Create admin user if not exists
        if (User::where('email', 'fran@gmail.com')->doesntExist()) {
            $admin = User::factory()
                ->admin()
                ->create([
                    'name' => 'Fran',
                    'surname' => 'Rey Castedo',
                    'email' => 'fran@gmail.com',
                ]);

            Address::factory()
                ->for($admin)
                ->create([
                    'address_type' => AddressType::Shipping,
                    'name' => 'Francisco',
                    'surname' => 'Rey Castedo',
                    'email' => 'franreycastedo@gmail.es',
                    'financial_number' => '00000000F',
                    'phone' => '617547428',
                    'address' => 'Lamas de prado 86',
                    'city' => 'Lugo',
                    'state' => 'Galiza',
                    'zip_code' => 27004,
                    'country' => 'España',
                ]);
        }
    }

    private function generateImage(string $path, string $imageName): void
    {
        $filePath = $path . '/' . $imageName;

        if (Storage::disk('public')->exists($filePath)) {
            return;
        }

        // Create a simple placeholder image using GD library
        $image = $this->createPlaceholderImage();

        // Save to temporary location
        $tempFile = tmpfile();
        imagepng($image, stream_get_meta_data($tempFile)['uri']);
        imagedestroy($image);

        // Put to Storage
        $imageContent = file_get_contents(stream_get_meta_data($tempFile)['uri']);
        Storage::disk('public')->put($filePath, $imageContent);
    }

    private function createPlaceholderImage(int $width = 200, int $height = 200): \GdImage
    {
        $image = imagecreatetruecolor($width, $height);
        $backgroundColor = imagecolorallocate($image, 220, 220, 220);
        $textColor = imagecolorallocate($image, 100, 100, 100);

        // Fill background
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);

        // Add border
        imagerectangle($image, 0, 0, $width - 1, $height - 1, $textColor);

        // Add placeholder text
        $text = 'Roteco';
        $fontSize = 5;
        $textX = ($width - strlen($text) * imagefontwidth($fontSize)) / 2;
        $textY = ($height - imagefontheight($fontSize)) / 2;
        imagestring($image, $fontSize, (int)$textX, (int)$textY, $text, $textColor);

        return $image;
    }
}
