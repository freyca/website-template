@extends('layouts.app', ['title' => config('custom.title')])

@inject('cart', 'App\Services\Cart')

@section('main-content')
<div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
        Shopping Cart
    </h2>

    <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
        @if($cart->isEmpty())
            <p class="container mx-auto">
                {{__('No products in cart')}}
            </p>
        @else
            @livewire('cart-items')
            @livewire('cart.cart-sidebar')
        @endif

    </div>
</div>
@endsection
