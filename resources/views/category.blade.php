@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    <div class="container mx-auto">
    <img src="{{@asset('/storage/' . $category->big_image)}}">
    <p class="text-3xl font-bold">{{$category->name}}</p>

    <x-markdown>
        {{ $category->description }}
    </x-markdown>

    <div class="mt-10 columns-3">
        @foreach ( $products as $product )
        <div class="w-full max-w-xs" style="border: 4px solid black">
            <a href="/producto/{{$product->name}}">
                <img src="{{@asset('/storage/' . $product->main_image)}}" style="max-height: 200px" />
                <h2 class="text-2xl font-bold"> {{$product->name}} </h2>
            </a>
            <p>{{$product->slogan}}</p>
        </div>
        @endforeach
    </div>
@endsection
