<form action={{ ! $film->slug ? route('films.store') : route('films.update', $film->slug) }} method="POST">

    @if ($film->slug)
        @method('patch')
    @endif

    @csrf

    <label>
        <span>Название фильма</span>
        <input type="text" name="name" value="{{ old('name') ?? $film->name }}">
        @error('name')
            @include('shared.error', ['message' => $message])
        @enderror
    </label>

    <label>
        <span>Режиссёр</span>
        <select name="director_id">
            <option value="">-</option>
            @foreach ($directors as $director)
                <option
                    value="{{ $director->id }}"
                    {{
                        ($film->slug
                            ? $film->director_id
                            : old('director_id')) == $director->id
                        ? "selected"
                        : ""
                    }}
                >{{ $director->full_name }}</option>
            @endforeach
        </select>
        @error('director_id')
            @include('shared.error', ['message' => $message])
        @enderror
    </label>

    <label>
        <span>Год выхода</span>
        <input type="number" name="year" minlength="4" maxlength="4" value="{{ old('year') ?? $film->year }}">
        @error('year')
            @include('shared.error', ['message' => $message])
        @enderror
    </label>

    <button type="submit">
        {{ ! $film->slug ? "Добавить" : "Сохранить" }}
    </button>

</form>
