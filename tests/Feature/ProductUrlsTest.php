<?php

use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Models\User;
use Database\Seeders\ProductComplementSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ProductSparePartSeeder;
use Database\Seeders\UserAdminSeeder;
use Database\Seeders\UserSeeder;

use function Pest\Laravel\{actingAs};
use function Pest\Laravel\{get};

test('product urls returns 200 if published and 403 if not', function () {
    $this->seed(ProductSeeder::class);

    $publishedProducts = Product::where('published', true)->get();

    foreach ($publishedProducts as $product) {
        $response = get('/producto/'.$product->slug);
        $response->assertStatus(200);
    }

    $notPublishedProducts = Product::where('published', false)->get();

    foreach ($notPublishedProducts as $product) {
        $response = get('/producto/'.$product->slug);
        $response->assertStatus(403);
    }
})->group('product-urls');

test('product complement urls returns 200 if published and 403 if not', function () {
    $this->seed(ProductComplementSeeder::class);
    $this->seed(ProductSeeder::class);

    $publishedComplements = ProductComplement::where('published', true)->get();

    foreach ($publishedComplements as $product) {
        $response = get('/complemento/'.$product->slug);
        $response->assertStatus(200);
    }

    $notPublishedComplements = ProductComplement::where('published', false)->get();

    foreach ($notPublishedComplements as $product) {
        $response = get('/complemento/'.$product->slug);
        $response->assertStatus(403);
    }
})->group('product-urls');

test('product spare part urls returns 200 if published and 403 if not', function () {
    $this->seed(ProductSparePartSeeder::class);
    $this->seed(ProductSeeder::class);

    $publishedSpareParts = ProductSparePart::where('published', true)->get();

    foreach ($publishedSpareParts as $product) {
        $response = get('/pieza-de-repuesto/'.$product->slug);
        $response->assertStatus(200);
    }

    $notPublishedSpareParts = ProductSparePart::where('published', false)->get();

    foreach ($notPublishedSpareParts as $product) {
        $response = get('/pieza-de-repuesto/'.$product->slug);
        $response->assertStatus(403);
    }
})->group('product-urls');

test('admin can access published and not published products', function () {
    $this->seed(ProductSparePartSeeder::class);
    $this->seed(ProductComplementSeeder::class);
    $this->seed(ProductSeeder::class);
    $this->seed(UserAdminSeeder::class);

    $products = Product::all();
    $productComplements = ProductComplement::all();
    $productSpareParts = ProductSparePart::all();

    /** @var User */
    $user = User::first();

    foreach ($products as $product) {
        $response = actingAs($user)->get('/producto/'.$product->slug);
        $response->assertStatus(200);
    }

    foreach ($productComplements as $product) {
        $response = actingAs($user)->get('/complemento/'.$product->slug);
        $response->assertStatus(200);
    }

    foreach ($productSpareParts as $product) {
        $response = actingAs($user)->get('/pieza-de-repuesto/'.$product->slug);
        $response->assertStatus(200);
    }
})->group('product-urls');

test('logged user cannnot access not published products', function () {
    $this->seed(ProductSparePartSeeder::class);
    $this->seed(ProductComplementSeeder::class);
    $this->seed(ProductSeeder::class);
    $this->seed(UserSeeder::class);

    $products = Product::where('published', false)->get();
    $productComplements = ProductComplement::where('published', false)->get();
    $productSpareParts = ProductSparePart::where('published', false)->get();

    /** @var User */
    $user = User::first();

    foreach ($products as $product) {
        $response = actingAs($user)->get('/producto/'.$product->slug);
        $response->assertStatus(403);
    }

    foreach ($productComplements as $product) {
        $response = actingAs($user)->get('/complemento/'.$product->slug);
        $response->assertStatus(403);
    }

    foreach ($productSpareParts as $product) {
        $response = actingAs($user)->get('/pieza-de-repuesto/'.$product->slug);
        $response->assertStatus(403);
    }
})->group('product-urls');
