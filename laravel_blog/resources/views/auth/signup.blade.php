@extends('layout')

@section('title', 'Зарегистрироваться')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

    @include('auth.type_selector', ['type' => 'signup'])

    <div class="form-container">
        <div class="form-container">
            <form action="{{ route('signup') }}" method="POST">

                @csrf

                <label>
                    <span>Ваше имя:</span>
                    <input type="text" name="name">
                </label>

                <label>
                    <span>Ваша фамилия:</span>
                    <input type="text" name="surname">
                </label>

                <label>
                    <span>Ваш логин:</span>
                    <input type="text" name="login">
                </label>

                <label>
                    <span>Ваш пароль:</span>
                    <input type="password" name="password1">
                </label>

                <div class="button-container">
                    <button type="submit">Зарегистрироваться</button>
                </div>

            </form>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="{{ asset('js/auth.js') }}"></script>

@endpush
