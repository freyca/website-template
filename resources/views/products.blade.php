@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
<x-product-grid :products="$products" />
@endsection