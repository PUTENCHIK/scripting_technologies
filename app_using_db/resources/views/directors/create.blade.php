@extends('layout')

@section('title', 'Добавить режиссёра')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')

    <h1>Добавление режиссёра</h1>

    @include('directors.form', ['director' => $empty])

@endsection
