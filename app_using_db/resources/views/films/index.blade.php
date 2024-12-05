@extends('layout')

@section('title', 'Фильмы')

@section('content')
    <h1>Фильмы</h1>

    <form action={{ route('films.create') }} method="GET">
        <button type="submit">Добавить фильм</button>
    </form>

    @if ($films->count())
        <p>Список фильмов:</p>
        <ul>
            @foreach ($films as $film)
                <li>
                    <a href={{ route('films.show', ['film' => $film->id]) }}>
                        {{ $film->name }}
                    </a>
                </li>    
            @endforeach
        </ul>
    @else
        <h3>Нет фильмов в базе</h3>
    @endif
@endsection