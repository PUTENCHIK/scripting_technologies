@extends('layout')

@section('title', 'Добавить фильм')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')

    <h1>Добавление нового фильма</h1>

    @include('films.form', ['film' => $empty, 'directors' => $directors])

@endsection
