<form action="{{ ! $director->slug ? route('directors.store') : route('directors.update', $director->slug) }}" method="POST">

    @if ($director->slug)
        @method('patch')
    @endif

    @csrf

    <label>
        <span>Полное имя режиссёра</span>
        <input type="text" name="full_name" value="{{ old('full_name') ?? $director->full_name }}">
        @error('full_name')
            @include('shared.error', ['message' => $message])
        @enderror
    </label>

    <button type="submit">
        {{ ! $director->slug ? "Добавить" : "Сохранить" }}
    </button>

</form>
