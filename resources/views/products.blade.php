@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Productos</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="producto bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="{{ asset('public/images/' . $product->imagen) }}" alt="{{ $product->nombre }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $product->nombre }}</h2>
                    <p class="text-gray-600 mt-2">{{ $product->descripcion }}</p>
                    <p class="text-gray-800 font-bold mt-2">{{ $product->precio }} &euro;</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
