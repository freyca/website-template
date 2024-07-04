@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
    <h1 class="mt-20 text-center text-3xl font-bold mb-4">
        {{ __('Categories') }}
    </h1>

    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($categories as $category)
                <x-category-container :category="$category" />
            @endforeach
        </div>
    </div>
@endsection
