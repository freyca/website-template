@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    @inject('cart', 'App\Services\Cart')

    @livewire('cart-items', ['cartItems' => $cart->getCart()])
@endsection
