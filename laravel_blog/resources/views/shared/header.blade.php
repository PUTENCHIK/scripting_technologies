<header>
    <div class="__content">
        <a href="{{ route('welcome') }}" class="logo no-link">
            <img src="{{ asset('images/icon.png') }}" alt="logo" class="logo">
            <span>Название блога</span>
        </a>
        <nav>
            <div>
                <a href="{{ route('moderate.index') }}" class='no-link'>Модерация</a>
            </div>

            <form action="{{ route('signin_page') }}" method="GET">
                <button type="submit">Авторизация</button>
            </form>
        </nav>
    </div>
</header>
