@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold m-10">
        Categories
    </h1>

    <div class="mt-10">
        @foreach ( $products as $product )
        <div class="w-full max-w-xs" style="border: 4px solid black">
            <a href="{{$product->name}}">
                <img src="{{@asset('/storage/' . $product->main_image)}}" style="max-height: 200px" />
                <h2 class="text-2xl font-bold"> {{$product->name}} </h2>
            </a>
            <p>{{$product->slogan}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
