@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    @include('partials.main-slider')
    <div class="container mx-auto text-3xl font-bold underline">
        Hello world!
    </h1>
@endsection
