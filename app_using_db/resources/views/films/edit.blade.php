@extends('layout')

@section('title', $film->name . ' - edit')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')

    <h1>Редактирование фильма</h1>

    @include('films.form', ['film' => $film, 'directors' => $directors])

@endsection
