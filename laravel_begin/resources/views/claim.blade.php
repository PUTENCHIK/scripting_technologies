@extends('layout')

@section('title', 'Заявка на участие')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <h1>Подать заявку на участие</h1>
    <div class="form-container">
        <fieldset>
            <form action="/claim" method="POST">
                @csrf()

                <label>
                    <span>Введите ваше имя:</span>
                    <input type="text" name="name" value="{{ old('name') }}">
                </label>
                @error('name')
                    @include('shared.error', ['message' => 'Имя не введено'])
                @enderror

                <label>
                    <span>Введите вашу фамилию:</span>
                    <input type="text" name="surname" value="{{ old('surname') }}">
                </label>
                @error('surname')
                    @include('shared.error', ['message' => 'Фамилия не введена'])
                @enderror

                <label>
                    <span>Выберите направление:</span>
                    <select name="trend">
                        <option {{ old('trend') == 'Web разработка' ? 'selected' : '' }}>Web разработка</option>
                        <option {{ old('trend') == 'Искусственный интеллект' ? 'selected' : '' }}>Искусственный интеллект</option>
                        <option {{ old('trend') == 'Компьютерное зрение' ? 'selected' : '' }}>Компьютерное зрение</option>
                    </select>
                </label>
                @error('trend')
                    @include('shared.error', ['message' => 'Не выбрано направление'])
                @enderror

                <label class="no-flex">
                    <input type="checkbox" name="agree" {{ old('agree') ? 'checked' : '' }}>
                    <span>Получать рассылку</span>
                </label>
                @error('agree')
                    @include('shared.error', ['message' => 'Надо бы согласиться'])
                @enderror

                <input type="submit" value="Отправить">
            </form>
        </fieldset>
    </div>
@endsection
