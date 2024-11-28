<form action={{ route('films.store') }} method="POST">

    @csrf

    <label>
        <span>Название фильма</span>
        <input type="text" name="name">
    </label>

    <label>
        <span>Автор</span>
        <select name="director_id">
            <option value="">-</option>
            @foreach ($directors as $index => $full_name)
                <option value="{{ $index }}">{{ $full_name }}</option>
            @endforeach
        </select>
    </label>

    <label>
        <span>Год выхода</span>
        <input type="number" name="year" min="1890"
                max="2100" minlength="4" maxlength="4">
    </label>

    <button type="submit">Добавить</button>
</form>