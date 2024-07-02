@extends('layouts.app', ['title' => config('custom.title')])

@section('main-content')
    @livewire('forms.contact-form')
@endsection
