@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    <div class="container mx-auto">
    <img src="{{$category->big_image}}">
    <p class="text-3xl font-bold">{{$category->name}}</p>
    <p>{{$category->description}}</p>

    <div class="mt-10">
        @foreach ( $products as $product )
        <div class="w-full max-w-xs" style="border: 4px solid black">
            {{$product->main_image}}
            <a href="{{$product->name}}">
                <h2 class="text-2xl font-bold"> {{$product->name}} </h2>
            </a>
            <p>{{$product->slogan}}</p>
        </div>
        @endforeach
    </div>
@endsection
