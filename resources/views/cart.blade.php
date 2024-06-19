@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    @inject('cart', 'App\Services\Cart')

    @if($cart->isEmpty())
        <p class="container mx-auto">No products in cart</p>
    @else
        @livewire('cart-items', ['cartItems' => $cart->getCart()])
    @endif
@endsection
