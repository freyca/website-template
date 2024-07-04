@extends('layouts.app', [
    'title' => config('custom.title'),
    'metaDescription' => 'Metadescripcion de la pagina de categorias',
])
@section('main-content')
    <h1 class="mt-20 text-center text-3xl font-bold mb-4">
        {{ __('Categories') }}
    </h1>

    <x-category-grid :categories="$categories" />
@endsection
