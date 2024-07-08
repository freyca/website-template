@extends('layouts.app', [
    'title' => config('custom.title'),
    'metaDescription' => $product->meta_description,
])

@inject(cart, '\App\Services\Cart')

@section('main-content')
    <div class="container mx-auto my-10 grid grid-cols-1 lg:grid-cols-2 gap-10">
        <div class="container">
            <x-product.product-image-gallery :product="$product" />
        </div>

        <div class="container">
            <p class="mb-4 text-justify">
                {!! $product->description !!}
            </p>

            <h1 class="font-bold">{{ $product->name }}</h1>
            <h2 class="py-2">{{ $product->slogan }}</h2>

            <div class="my-2">
                @if ($product->price_with_discount)
                    <span class="text-xl font-bold text-tertiary-600 mr-2">
                        {{ $product->price_with_discount }} €
                    </span>
                    <span class="text-primary-700 pr-2 line-through">
                        {{ $product->price }} €
                    </span>
                @else
                    <span class="text-xl font-bold text-tertiary-600">
                        {{ $product->price }} €
                    </span>
                @endif
            </div>
            @livewire('buttons.add-to-cart', ['product' => $product])

            <br />
        </div>

        <br />
    </div>

    <div class="container mx-auto">
        @if (count($features) > 0)
            <p class="py-2 mb-4 font-bold text-lg text-center">
                Features
            </p>
            @foreach ($features as $feature)
                <p class="font-bold">{{ $feature->name }}</p>
                <p>{!! $feature->description !!}</p>
                <br />
            @endforeach
        @endif
    </div>
@endsection
