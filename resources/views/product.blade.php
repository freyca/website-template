@extends('layouts.app')
@inject(cart, '\App\Services\Cart')

@section('title', config('custom.title'))
@section('description', $product->short_description)

@section('main-content')
    <div class="container mx-auto">
        {{-- Aqui necesitamos hacer una galeria de imagenes --}}
        <img src="{{@asset('/storage/' . $product->main_image)}}">
        @foreach ( $product->images as $productImage )
            <img src="{{@asset('/storage/' . $productImage)}}">
        @endforeach
        <h1>{{$product->name}}</h1>
        @if ($product->price_with_discount)
            {{-- Tachamos el precio anterior y lo mostramos con descuento --}}
            <span class="line-through">{{$product->price}} €</span>
            <span>{{$product->price_with_discount}} €</span>
        @else
            <span {{$product->price}}</span>
        @endif
        <p>{{$product->slogan}}</p>
        <span>{{$product->description}}</span>
@endsection
