@extends('layout')

@section('title', 'Модерация комментариев')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/moderate.css') }}">
@endpush

@section('content')
    
    <h1>Модерация комментариев</h1>

    <div class="app-container">
        @include('moderate.section_selector')

        <div v-if="isCommentsSection" class="comments-container">
            <div v-if="!loading && comments.length" class="comments-table">
                <div class="comment head">
                    <div></div>
                    <div>ID поста</div>
                    <div>Пользователь</div>
                    <div>Комментарий</div>
                    <div>Статус</div>
                    <div>Время и дата</div>
                </div>
                <div v-for="comment in comments" class="comment">
                    <div>#@{{ comment.id }}</div>
                    <div>@{{ comment.post_id }}</div>
                    <div>@{{ comment.user }}</div>
                    <div>@{{ comment.text }}</div>
                    <div>
                        <form @submit="(event) => changeCommentStatus(event, comment.id)" method="POST">
                            @csrf
                            @method('patch')
                            <select @change="$event.target.parentElement.submit()" name="status" :disabled="sending">
                                <option
                                    v-for="(status, key) in statuses"
                                    :value="status.value"
                                    :selected="status.value == comment.status"
                                >
                                    @{{ status.name }}
                                </option>
                            </select>
                        </form>
                    </div>
                    <div>@{{ formatDate(comment.created_at) }}</div>
                </div>
            </div>
            <div v-else-if="!loading">
                Нет комментариев
            </div>
            <div v-else>
                Комментарии загружаются...
            </div>
        </div>

        <div v-else>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="{{ asset('js/moderate.js') }}"></script>    
@endpush