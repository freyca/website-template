<?php

use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductComplement;
use App\Models\OrderProductSparePart;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductFeature;
use App\Models\ProductFeatureValue;
use App\Models\ProductSparePart;
use App\Models\ProductVariant;
use App\Models\User;

test('db has correct items after been seeded', function () {
    expect(Category::count())->toBe(0);
    expect(Order::count())->toBe(0);
    expect(OrderProduct::count())->toBe(0);
    expect(OrderProductComplement::count())->toBe(0);
    expect(OrderProductSparePart::count())->toBe(0);
    expect(Product::count())->toBe(0);
    expect(ProductComplement::count())->toBe(0);
    expect(ProductSparePart::count())->toBe(0);
    expect(User::count())->toBe(0);
    expect(Address::count())->toBe(0);
    expect(ProductFeature::count())->toBe(0);
    expect(ProductFeatureValue::count())->toBe(0);
    expect(ProductVariant::count())->toBe(0);

    $this->seed();

    expect(Category::count())->toBe(5);
    expect(Order::count())->toBe(40);
    expect(OrderProduct::count())->toBe(80);
    expect(OrderProductComplement::count())->toBe(80);
    expect(OrderProductSparePart::count())->toBe(80);
    expect(Product::count())->toBe(55);
    expect(ProductComplement::count())->toBe(50);
    expect(ProductSparePart::count())->toBe(50);
    expect(User::count())->toBe(11);
    expect(Address::count())->toBe(10);
    expect(ProductFeature::count())->toBe(10);
    expect(ProductFeatureValue::count())->toBe(20);
    expect(ProductVariant::count())->toBe(10);
});
