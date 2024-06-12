@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    <div class="container text-3xl font-bold underline">
    <img src="{{$category->big_image}}">
    <p>{{$category->name}}</p>
    <p>{{$category->description}}</p>

        @foreach ( $products as $product)
            <img src="{{$product->main_image}}">
            <a href="/producto/{{$product->name}}">{{$product->name}}</a>
        @endforeach
    </h1>
@endsection
