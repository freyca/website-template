@extends('layouts.app')

@section('title', config('custom.title'))
@section('description', $product->short_description)

@section('main-content')
    <div class="container mx-auto">
        {{-- Aqui necesitamos hacer una galeria de imagenes --}}
        <img src="{{$product->main_image}}">
        @foreach ( $product->images as $productImage )
            <img src="{{$productImage}}">
        @endforeach
        <h1>{{$product->name}}</h1>
        <span>{{$product->price}}</span>
        @if ($product->price_with_discount)
            {{-- Tachamos el precio anterior y lo mostramos con descuento --}}
            <span>{{$product->price_with_discount}}</span>
        @endif
        <p>{{$product->slogan}}</p>
        <span>{{$product->description}}</span>
@endsection
