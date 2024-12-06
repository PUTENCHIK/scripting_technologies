@extends('layout')

@section('title', $film->name)

@section('content')

    <h1>"{{ $film->name }}"</h1>

    <p>
        Год выхода: <b>{{ $film->year }}</b>
    </p>

    <p>
        Режиссёр:
        <b>
            @if (isset($director[0]))
                <a href="{{ route('directors.show', $director[0]->slug) }}">{{ $director[0]->full_name }}</a>
            @else
                -
            @endif
        </b>

    </p>

    <p>
        Добавлен в базу: <b>{{ $film->created_at }} UTC</b>
    </p>
    <p>
        Изменён: <b>{{ $film->updated_at }} UTC</b>
    </p>

    <form action="{{ route('films.edit', $film->slug) }}" method="GET">
        <button type="submit">Редактировать</button>
    </form>

    <br>

    <form action="{{ route('films.delete', $film->slug) }}" method="POST">
        @method('delete')
        @csrf
        <button class="danger" type="submit">Удалить</button>
    </form>

@endsection
