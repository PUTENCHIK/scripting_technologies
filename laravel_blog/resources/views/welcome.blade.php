@extends('layout')

@section('title', 'Главная')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush

@section('content')

    <h1>Название блога</h1>

    {{-- <form action="{{ route('comments.store') }}" method="POST">
        @csrf

        <label>
            <span>ID поста:</span>
            <input type="number" name="post_id">
        </label>

        <label>
            <span>Пользователь:</span>
            <input type="text" name="user">
        </label>

        <label>
            <span>Текст:</span>
            <textarea name="text"></textarea>
        </label>

        <div class="form-buttons-block">
            <button type="submit">Добавить</button>
        </div>

    </form> --}}

    <div class="posts-container">
        <div class="button-box">
            <button @click="showForm = true; updatingPost = null" v-if="!showForm">Создать пост</button>
        </div>

        <form @submit="(event) => createPost(event)" v-if="showForm" name="create-post">
            @csrf

            <label>
                <span>Текст поста:</span>
                <textarea name="text"></textarea>
                <div v-if="errors['text']" class="error">@{{ errors['text'][0] }}</div>
            </label>

            <label>
                <span>URL изображения (необязательно):</span>
                <input type="text" name="path" placeholder="https://your/image/path.jpg">
                <div v-if="errors['path']" class="error">@{{ errors['path'][0] }}</div>
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
                        <form v-if="updatingPost !== post.id">
                            <button @click="() => editUpdatingPost(post.id)" type="button" class="no-shell">
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

                <div v-if="updatingPost !== post.id" class="post__text">@{{ post.text }}</div>
                <div v-if="updatingPost !== post.id" class="post__image" v-if="post.path">
                    <img :src="post.path" v-bind:alt="'unkown: ' + post.path">
                </div>
                <div v-if="updatingPost === post.id">
                    <form @submit="(event) => updatePost(event, post.id)" name="update-post">
                        @method('patch')
                        @csrf

                        <label>
                            <span>Текст поста:</span>
                            <textarea name="text">@{{ post.text }}</textarea>
                            <div v-if="errors['text']" class="error">@{{ errors['text'][0] }}</div>
                        </label>

                        <label>
                            <span>URL изображения (необязательно):</span>
                            <input type="text" name="path" placeholder="https://your/image/path.jpg" :value="post.path">
                            <div v-if="errors['path']" class="error">@{{ errors['path'][0] }}</div>
                        </label>

                        <div class="form-buttons-block">
                            <button @click="() => editUpdatingPost(null)" type="button" class="secondary">Закрыть</button>
                            <button type="submit" :disabled="sending">Сохранить</button>
                        </div>

                    </form>
                </div>

                <div v-if="updatingPost !== post.id" class="comments-box">
                    <h3>Комментарии</h3>
                    <div v-if="post.comments.length" class="comments">
                        <div v-for="comment in post.comments" class="comment">
                            <div class="comment__header">
                                <div>#@{{ comment.id }}</div>
                                <div>@{{ comment.user }}</div>
                                <div class="datetime-container">@{{ formatDate(comment.created_at) }}</div>
                            </div>
                            <div class="comment__body">
                                @{{ comment.status == 20 ? comment.text : 'Комментарий на модерации' }}
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        Оставьте первый комментарий под этим постом!
                    </div>
                    <div class="add-comment-container">
                        <form @submit.prevent="(event) => addComment(event, post.id)">
                            @csrf
                            <label>
                                <span>Имя пользователя:</span>
                                <input type="text" name="user">
                                <div v-if="commentErrors.id == post.id && commentErrors.errors['user']" class="error">
                                    @{{ commentErrors.errors['user'][0] }}
                                </div>
                            </label>
                            <label class="fill-container">
                                <span>Комментарий:</span>
                                <textarea name="text"></textarea>
                                <div v-if="commentErrors.id == post.id && commentErrors.errors['text']" class="error">
                                    @{{ commentErrors.errors['text'][0] }}
                                </div>
                            </label>
                            <div class="button-container">
                                <button type="submit">Отправить</button>
                            </div>
                        </form>
                    </div>
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
