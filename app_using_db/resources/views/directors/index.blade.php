@extends('layout')

@section('title', 'Режиссёры')

@section('content')
    <h1>Режиссёры</h1>

    <form action={{ route('directors.create') }} method="GET">
        <button type="submit">Добавить режиссёра</button>
    </form>

    @if ($directors->count())
        <p>Список режиссёров:</p>
        <ul>
            @foreach ($directors as $director)
                <li>
                    <a href={{ route('directors.show', ['director' => $director->id]) }}>
                        {{ $director->name }}
                    </a>
                </li>    
            @endforeach
        </ul>
    @else
        <h3>Нет режиссёров в базе</h3>
    @endif
@endsection