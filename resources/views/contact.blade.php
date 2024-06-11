@extends('layouts.app')

@section('title', config('custom.title'))

@section('main-content')
    @component('livewire.contact-form')
        <strong>Whoops!</strong> Something went wrong!
    @endcomponent
@endsection
