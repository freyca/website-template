@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold m-10">
        Categories
    </h1>

    <div class="columns-3">
        @foreach ( $categories as $category )
        <div class="w-full max-w-xs" style="border: 4px solid black">
            <a href="{{$category->slug}}">
                <img src="{{@asset('/storage/' . $category->big_image)}}" style="max-height: 200px" />
                <h2 class="text-2xl font-bold"> {{$category->name}} </h2>
            </a>
            <p>{{$category->slogan}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
