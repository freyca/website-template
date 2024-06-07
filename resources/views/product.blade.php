@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    <div class="container text-3xl font-bold underline">
        @php
            dump($product->name)
        @endphp
    </h1>
@endsection
