@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
    <x-sliders.main-slider />

    <div class="container mx-auto">
        <h2 class="text-3xl font-bold m-10">
            {{ __('Categories') }}
        </h2>

        <div class="mt-10 columns-3 inline-flex">
            @foreach ($categories as $category)
                <x-category-container :category="$category" />
            @endforeach
        </div>
    </div>

    <div class="container mx-auto">
        <h2 class="text-3xl font-bold m-10">
            Products
        </h2>

        <div class="mt-10 columns-3 inline-flex">
            @foreach ($products as $product)
                <x-product-container :product="$product" />
            @endforeach
        </div>
    </div>
@endsection
