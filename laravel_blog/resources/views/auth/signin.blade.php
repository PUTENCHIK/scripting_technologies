@extends('layout')

@section('title', 'Войти')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

    @include('auth.type_selector', ['type' => 'signin'])

    <div class="form-container">
        <form action="{{ route('signin') }}" method="POST">

            @csrf

            <label>
                <span>Ваш логин:</span>
                <input type="text" name="login">
            </label>

            <label>
                <span>Ваш пароль:</span>
                <input type="password" name="password">
            </label>

            <div class="button-container">
                <button type="submit">Войти</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')

    <script src="{{ asset('js/auth.js') }}"></script>

@endpush
