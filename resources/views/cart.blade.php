@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    @inject('cart', 'App\Services\Cart')

    @if($cart->isEmpty())
        <p class="container mx-auto">No products in cart</p>
    @else
        <div class="container mx-auto my-auto columns-3">
            <span>Product name</span>
            <span>Product quantity</span>
            <span>Product price</span>
        </div>

        @foreach ( $cart->getCart() as $cartItem )
            <x-show-product-in-cart
                :product="data_get($cartItem, 'product')"
                :quantity="data_get($cartItem, 'quantity')"
                :cart="$cart"
            />
        @endforeach
    @endif
@endsection
