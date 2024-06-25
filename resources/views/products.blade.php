@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold m-10">
            Products
        </h1>

        <div class="columns-3 inline-flex">
            @foreach ($products as $product)
                <x-product-container :product="$product" />
            @endforeach
        </div>
    </div>
@endsection
