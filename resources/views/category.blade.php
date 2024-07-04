@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
    <div class="container mx-auto p-4">
        <h1 class="mt-20 text-3xl text-center font-bold mb-4">
            {{ __('Category') }}: {{ $category->name }}
        </h1>
        <div class="grid gap-4">
            <img src="{{ @asset('/storage/' . $category->big_image) }}">
            <p class="text-3xl font-bold">
                {{ $category->name }}
            </p>

            {!! $category->description !!}

            <x-product-grid :products="$products" />
        </div>
    </div>
@endsection
