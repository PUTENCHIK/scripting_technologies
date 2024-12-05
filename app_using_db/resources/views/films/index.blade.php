@extends('layout')

@section('title', 'Фильмы')

@section('content')
    <h1>Фильмы</h1>

    <form action={{ route('films.create') }} method="GET">
        <button type="submit">Добавить фильм</button>
    </form>

    @if ($films->count())
        <h2>Список фильмов</h2>
        <ol>
            @foreach ($films as $film)
                <li>
                    <a href={{ route('films.show', $film->slug) }}>
                        "{{ $film->name }}"
                    </a>
                </li>
            @endforeach
        </ol>
    @else
        <h3>Нет фильмов в базе</h3>
    @endif
@endsection
