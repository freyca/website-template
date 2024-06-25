@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold m-10">
            Categories
        </h1>

        <div class="mt-10 columns-3 inline-flex">
            @foreach ($categories as $category)
                <x-category-container :category="$category" />
            @endforeach
        </div>
    </div>
@endsection
