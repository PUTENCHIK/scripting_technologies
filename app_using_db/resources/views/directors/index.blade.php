@extends('layout')

@section('title', 'Режиссёры')

@section('content')
    <h1>Режиссёры</h1>

    <form action={{ route('directors.create') }} method="GET">
        <button type="submit">Добавить режиссёра</button>
    </form>

    @if ($directors->count())
        <h2>Список режиссёров</h2>
        <ol>
            @foreach ($directors as $director)
                <li>
                    <a href={{ route('directors.show', $director->slug) }}>
                        {{ $director->full_name }}
                    </a>
                </li>
            @endforeach
        </ol>
    @else
        <h3>Нет режиссёров в базе</h3>
    @endif
@endsection
