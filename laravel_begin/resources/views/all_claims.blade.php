@extends('layout')

@section('title', 'Все заявки')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/all-claims.css') }}">
@endpush

@section('content')
    @if (empty($claims))
        <div>Ещё нет ни одной заявки</div>
    @else
        <div class="claims-container">
            <div class="container-row head">
                <div>№</div>
                <div>Имя</div>
                <div>Фамилия</div>
                <div>Направление</div>
                <div>Получает рассылку</div>
            </div>
            @foreach ($claims as $index => $claim)
                <div class="container-row claim">
                    <div>{{ $index+1 }}</div>
                    <div>{{ $claim->name }}</div>
                    <div>{{ $claim->surname }}</div>
                    <div>{{ $claim->trend }}</div>
                    <div>{{ $claim->agree ?? false == "on" ? "Да" : "Нет" }}</div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
