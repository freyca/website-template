@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    <h1 class="container text-3xl font-bold underline">
        Categories
    </h1>

    @foreach ( $categories as $category )
        <a href="{{$category->name}}">
            <h2> {{$category->name}} </h2>
        </a>
    @endforeach
@endsection
