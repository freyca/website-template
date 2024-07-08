@extends('layouts.app', [
    'title' => config('custom.title'),
    'metaDescription' => $category->name,
])
@section('main-content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl text-center font-bold mt-6 mb-10">
            {{ __('Category') }}: {{ $category->name }}
        </h1>
        <div class="grid grid-cols-1 my-4 gap-4 lg:grid-cols-2">
            <img class="rounded-lg" src="{{ @asset('/storage/' . $category->big_image) }}">
            <div>
                <h2 class="text-3xl font-bold mb-10">
                    {{ $category->name }}
                </h2>
                <hr />
                <p class="text-justify mt-4">
                    {!! $category->description !!}
                </p>
            </div>
        </div>
        <hr />
        <x-product-grid :products="$products" />

    </div>
@endsection
