@extends('layout')

@section('title', $director->full_name . ' - edit')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')

    <h1>Редактирование режиссёра</h1>

    @include('directors.form', ['director' => $director])

@endsection
