<div class="auth-type">
    <div class="variant {{ $type == 'signin' ? 'chosen' : '' }}">
        <a href="{{ route('signin_page') }}" class="no-link">
            Войти
        </a>
    </div>

    <div class="line"></div>

    <div class="variant {{ $type == 'signup' ? 'chosen' : '' }}">
        <a href="{{ route('signup_page') }}" class="no-link">
            Регистрация
        </a>
    </div>
</div>
