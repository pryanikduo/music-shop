<header class="site-header">
    <nav class="navigate-menu">
        <div class="logo-container">
            <img src="img/logo.svg" class="logo-menu">
        </div>
        <a href="/" class="navigate-item"><span class="navigate-text">Главная</span></a>
        <div class="navigate-dropdown-menu">
            <a href="/catalog" class="navigate-item">
                <span class="navigate-text">Каталог</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="/catalog#1">Струнные</a></li>
                <li><a href="/catalog#2">Клавишные</a></li>
                <li><a href="/catalog#3">Смычковые</a></li>
                <li><a href="/catalog#4">Ударные</a></li>
            </ul>
        </div>
        <a href="/news" class="navigate-item"><span class="navigate-text">Новости и Акции</span></a>
        <a href="/about" class="navigate-item"><span class="navigate-text">О нас</span></a>
        <a href="/cart" class="cart"><img src="img/bascet.svg"></a>

        <!-- Блок авторизации -->
        @guest
            <a href="{{ route('login') }}" class="navigate-item auth-btn">Вход</a>
            <a href="{{ route('register') }}" class="navigate-item auth-btn">Регистрация</a>
        @else
    <div class="user-controls" style="display: flex; align-items: center; gap: 15px;">
        <span class="user-name" style="font-weight: bold;">{{ Auth::user()->name }}</span>

        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn" style="background-color: #e53e3e; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px;">
                Выйти
            </button>
        </form>
    </div>
@endguest
    </nav>
</header>