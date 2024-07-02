@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
    <div class="container mx-auto">
        <img src="{{ @asset('/storage/' . $category->big_image) }}">
        <p class="text-3xl font-bold">{{ $category->name }}</p>

        {!! $category->description !!}

        <x-product-grid :products="$products" />
    </div>
@endsection
