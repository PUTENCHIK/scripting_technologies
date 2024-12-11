<header>
    <div class="__content">
        <a href="{{ route('welcome') }}" class="logo no-link">
            <img src="{{ asset('images/icon.png') }}" alt="logo" class="logo">
            <span>Название блога</span>
        </a>
        <nav>
            <div>
                <a href="route('themes')" class='no-link'>Темы</a>
                <a href="route('users')" class='no-link'>Пользователи</a>
            </div>

            <form action="{{ route('signin_page') }}" method="GET">
                <button type="submit">Авторизация</button>
            </form>
        </nav>
    </div>
</header>
