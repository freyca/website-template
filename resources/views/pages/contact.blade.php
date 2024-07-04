@extends('layouts.app', [
    'title' => config('custom.title'),
    'metaDescription' => 'Metadescripcion de la pagina de contacto',
])
@section('main-content')
    @livewire('forms.contact-form')
@endsection
