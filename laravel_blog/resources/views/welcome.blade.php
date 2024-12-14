@extends('layout')

@section('title', 'Главная')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush

@section('content')

    <h1>Название блога</h1>

    <div class="posts-container">
        <div class="button-box">
            <button @click="showForm = true" v-if="!showForm">Создать пост</button>
        </div>

        <form @submit="(event) => createPost(event)" v-if="showForm" name="create-post">
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

        <div v-if="!loading && posts.length" class="posts-box">
            <div v-for="post in posts" class="post-box">
                <div class="post__header">
                    <div class="post__info">
                        <span>#@{{ post.id }}</span>
                        <span>@{{ formatDate(post.created_at) }}</span>
                    </div>
                    <div class="post__buttons">
                        <form>
                            @csrf
                            <button type="submit" class="no-shell">
                                <img src="{{ asset('images/edit.png') }}" alt="edit">
                            </button>
                        </form>
                        <form @submit="(event) => deletePost(event, post.id)" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="no-shell">
                                <img src="{{ asset('images/delete.png') }}" alt="delete">
                            </button>
                        </form>
                    </div>
                </div>
                <div class="post__text">@{{ post.text }}</div>
                <div class="post__image" v-if="post.path">
                    <img :src="post.path" v-bind:alt="'unkown: ' + post.path">
                </div>
                
            </div>
        </div>
        <div v-else-if="!loading">В блоге нет ни одного поста.</div>
        <div v-else>Загрузка постов...</div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="{{ asset('js/posts.js') }}"></script>
@endpush
