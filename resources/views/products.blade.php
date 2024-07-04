@extends('layouts.app', [
    'title' => config('custom.title'),
    'metaDescription' => 'Metadescripcion de la pagina de productos',
])
@section('main-content')
    <x-product-grid :products="$products" />
@endsection
