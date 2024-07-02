@extends('layouts.app', ['title' => config('custom.title')])

@inject(cart, '\App\Services\Cart')

@section('meta-description', $product->meta_description)

@section('main-content')
<div class="container mx-auto">

    <x-product.product-image-gallery :product="$product" />

    <h1 class="font-bold">{{$product->name}}</h1>

    @if ($product->price_with_discount)
    {{-- Tachamos el precio anterior y lo mostramos con descuento --}}
    <span class="line-through">{{$product->price}} €</span>
    <span>{{$product->price_with_discount}} €</span>
    @else
    <span> {{$product->price}} €</span>
    @endif

    @livewire('buttons.add-to-cart', ['product' => $product])
    @livewire('buttons.remove-from-cart', ['product' => $product])

    <p class="py-2">{{$product->slogan}}</p>
    <br />
    <p>{!! $product->description !!}</p>
    <br />

    @if (count($features) > 0)
    <h3 class="py-2 font-bold text-lg">Features</h3>
    <br />
    @foreach ( $features as $feature )
    <p class="font-bold">{{$feature->name}}</p>
    <p>{!! $feature->description !!}</p>
    <br />
    @endforeach
    @endif
</div>
@endsection