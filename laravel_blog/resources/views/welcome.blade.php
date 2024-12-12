@extends('layout')

@section('title', 'Главная')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush

@section('content')

    <h1>Название блога</h1>

    <div class="posts-container">
        <div class="button-box">
            {{-- <button @click="count++">@{{ count }}</button> --}}
            <button @click="showForm = true" v-if="!showForm">Создать пост</button>
        </div>

        <form @submit="(event) => onSubmit(event)" v-if="showForm" name="create-post">
            @csrf

            <label>
                <span>Текст поста:</span>
                <textarea name="text"></textarea>
            </label>

            <label>
                <span>URL изображения (необязательно):</span>
                <input type="text" name="path" placeholder="https://your/image/path.jpg">
            </label>

            <div class="form-buttons-block">
                <button @click="closeForm" type="button" class="secondary">Закрыть</button>
                <button type="submit" :disabled="sending">Создать</button>
            </div>

        </form>

        <h2>Посты</h2>

        <div v-if="posts.length" class="posts-box">
            <div v-for="post in posts" class="post-box">
                @{{ post.text }}
                <br>
                @{{ post.path }}
            </div>
        </div>
        <div v-else>В блоге нет ни одного поста.</div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="{{ asset('js/posts.js') }}"></script>
@endpush
