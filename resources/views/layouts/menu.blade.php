<header class="site-header">
    <nav class="navigate-menu">
        <div class="logo-container">
            <img src="{{ asset('img/logo.svg') }}" class="logo-menu">
        </div>
        <a href="/" class="navigate-item"><span class="navigate-text">Главная</span></a>
        <div class="navigate-dropdown-menu">
            <a href="{{ route('catalog') }}" class="navigate-item">
                <span class="navigate-text">Каталог</span>
            </a>
            <ul class="dropdown-menu">
                @include('layouts.partials.menu_recursive', ['categories' => $menuCategories])
            </ul>
        </div>
        <a href="/news" class="navigate-item"><span class="navigate-text">Новости и Акции</span></a>
        <a href="/about" class="navigate-item"><span class="navigate-text">О нас</span></a>
        <a href="/cart" class="cart" style="position: relative;">
    <img src="{{ asset('img/bascet.svg') }}">
    @if(isset($cartCount) && $cartCount > 0)
        <span class="cart-count" style="position: absolute; top: -8px; right: -12px; background-color: #e53e3e; color: white; font-size: 12px; font-weight: bold; padding: 2px 6px; border-radius: 50%; min-width: 18px; text-align: center;">
            {{ $cartCount }}
        </span>
    @endif
</a>

        <!-- Блок авторизации -->
        @guest
            <a href="{{ route('login') }}" class="auth-btn">Вход</a>
            <a href="{{ route('register') }}" class="auth-btn">Регистрация</a>
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
    @stack('scripts')
</header>