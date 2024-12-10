@extends('layout')

@section('title', 'Авторизация')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

<?php

$a = 1;

?>


@section('content')

    <div class="auth-type">
        <label>
            <input type="radio" class="hidden" name="auth-type" value="signin">
            <span>Войти</span>
        </label>
        <div class="line"></div>
        <label>
            <input type="radio" class="hidden" name="auth-type">
            <span>Регистрация</span>
        </label>
    </div>

@endsection
