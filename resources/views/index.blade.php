@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
    <x-sliders.main-slider />

    <hr class="mt-10 w-100" />

    <div class="container mx-auto">
        <h2 class="flex text-3xl font-bold my-10 mx-auto justify-center">
            {{ __('Categories') }}
        </h2>

        <div class="mt-10 mx-auto columns-3 flex flex-row justify-center">
            @foreach ($categories as $category)
                <x-category-container :category="$category" />
            @endforeach
        </div>
    </div>

    <hr class="mt-10 w-100" />

    <div class="container mx-auto">
        <h2 class="flex text-3xl font-bold my-10 mx-auto justify-center">
            {{ __('Products') }}
        </h2>

        <div class="flex flex-row flex-wrap mt-10 mx-auto">
            @foreach ($products as $product)
                <x-product.product-card :product="$product" />
            @endforeach
        </div>
    </div>
@endsection
