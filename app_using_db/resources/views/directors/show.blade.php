@extends('layout')

@section('title', $director->full_name)

@section('content')

    <h1>{{ $director->full_name }}</h1>

    @if ($films->count())
        <h2>Фильмы режиссёра</h2>

        <ol>
            @foreach ($films as $film)
                <li>
                    <a href="{{ route('films.show', $film->slug) }}">"{{ $film->name }}"</a>
                </li>
            @endforeach
        </ol>

    @else
        <p>У режиссёра нет ни одного фильма</p>
    @endif

    <p>
        Добавлен в базу: <b>{{ $director->created_at }} UTC</b>
    </p>
    <p>
        Изменён: <b>{{ $director->updated_at }} UTC</b>
    </p>

    <form action="{{ route('directors.edit', $director->slug) }}" method="GET">
        <button type="submit">Редактировать</button>
    </form>

    <br>

    <form action="{{ route('directors.delete', $director->slug) }}" method="POST">
        @method('delete')
        @csrf
        <button class="danger" type="submit">Удалить</button>
    </form>

@endsection
