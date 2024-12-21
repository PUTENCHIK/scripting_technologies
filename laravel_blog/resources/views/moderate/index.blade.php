@extends('layout')

@section('title', 'Модерация комментариев')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/moderate.css') }}">
@endpush

@section('content')

    <h1>Модерация комментариев</h1>

    <div class="app-container">
        @include('moderate.section_selector')

        <div class="content-container">
            <div v-if="!loading && (isCommentsSection && comments.length || !isCommentsSection)" class="content-table">
                <div v-if="isCommentsSection" class="line head">
                    <div></div>
                    <div>ID поста</div>
                    <div>Пользователь</div>
                    <div>Комментарий</div>
                    <div>Статус</div>
                    <div>Время и дата</div>
                </div>
                <div v-else class="line head">
                    <div>Название</div>
                    <div>Локализация</div>
                    <div>Системное значение</div>
                </div>

                <div v-if="isCommentsSection" v-for="comment in comments" class="line">
                    <div>#@{{ comment.id }}</div>
                    <div>@{{ comment.post_id }}</div>
                    <div>@{{ comment.user }}</div>
                    <div>@{{ comment.text }}</div>
                    <div>
                        <form
                                @submit="(event) => changeCommentStatus(event, comment.id)"
                                method="POST"
                        >
                            @csrf
                            @method('patch')
                            <select @change="(event) => onChangeStatus(event)" name="status" :disabled="sending">
                                <option
                                    v-for="(status, key) in statuses"
                                    :value="status.value"
                                    :selected="status.value == comment.status"
                                >
                                    @{{ status.name }}
                                </option>
                            </select>
                            <input type="submit" name="submit" class="hidden">
                        </form>
                    </div>
                    <div>@{{ formatDate(comment.created_at) }}</div>
                </div>
                <div v-else v-for="(value, name) in statuses" class="line">
                    <div>@{{ name }}</div>
                    <div>@{{ value.name }}</div>
                    <div>@{{ value.value }}</div>
                </div>
            </div>
            <div v-else-if="!loading">
                <span v-if="isCommentsSection">Нет комментариев</span>
                <span v-else>Нет статусов комментариев</span>
            </div>
            <div v-else>
                Контент загружается...
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="{{ asset('js/moderate.js') }}"></script>
@endpush
