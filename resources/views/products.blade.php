@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Productos</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <x-product.product-card :product="$product" />
        @endforeach
    </div>
</div>
@endsection
