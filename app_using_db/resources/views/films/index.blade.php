@extends('layout')

@section('title', 'Фильмы')

@section('content')
    <div class="__content">
        <h1>Фильмы</h1>

        <form action={{ route('films.create') }} method="GET">
            <button type="submit">Добавить фильм</button>
        </form>

        @if ($films->count())
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
            <p>Нет фильмов в базе</p>
        @endif
    </div>
@endsection