<header class="site-header">
    <nav class="navigate-menu">
        <div class="logo-container">
            <a href="{{ route('main', ['locale' => app()->getLocale()]) }}">
                <img src="{{ asset('img/logo.svg') }}" class="logo-menu">
            </a>
        </div>
        <a href="{{ route('main', ['locale' => app()->getLocale()]) }}" class="navigate-item"><span class="navigate-text">{{ __('messages.main') }}</span></a>
        <div class="navigate-dropdown-menu">
            <a href="{{ route('catalog', ['locale' => app()->getLocale()]) }}" class="navigate-item">
                <span class="navigate-text">{{ __('messages.catalog') }}</span>
            </a>
            <ul class="dropdown-menu">
                @include('layouts.partials.menu_recursive', ['categories' => $menuCategories])
            </ul>
        </div>
        <a href="{{ route('news', ['locale' => app()->getLocale()]) }}" class="navigate-item"><span class="navigate-text">{{ __('messages.news') }}</span></a>
        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="navigate-item"><span class="navigate-text">{{ __('messages.about') }}</span></a>
        <a href="{{ route('cart.index', ['locale' => app()->getLocale()]) }}" class="cart" style="position: relative;">
            <img src="{{ asset('img/bascet.svg') }}">
            <span id="cart-count" class="cart-count" style="position: absolute; top: -8px; right: -12px; background-color: #e53e3e; color: white; font-size: 12px; font-weight: bold; padding: 2px 6px; border-radius: 50%; min-width: 18px; text-align: center; {{ $cartCount > 0 ? '' : 'display: none;' }}">
                {{ $cartCount }}
            </span>
        </a>

        <!-- Блок авторизации -->
        @guest
            <a href="{{ route('login', ['locale' => app()->getLocale()]) }}" class="auth-btn">{{ __('messages.login') }}</a>
            <a href="{{ route('register', ['locale' => app()->getLocale()]) }}" class="auth-btn">{{ __('messages.register') }}</a>
        @else
            <div class="user-controls" style="display: flex; align-items: center; gap: 15px;">
                <span class="user-name" style="font-weight: bold;">{{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout', ['locale' => app()->getLocale()]) }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn" style="background-color: #e53e3e; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px;">
                        {{ __('messages.logout') }}
                    </button>
                </form>
            </div>
        @endguest

       <!-- Переключатель языка -->
        <div class="language-switcher" style="display: flex; gap: 10px; align-items: center; margin-left: 15px;">
            @foreach(config('app.locales') as $code => $name)
                @if($code != app()->getLocale())
                    <a href="{{ route('language.switch', ['locale' => $code]) }}" style="color: var(--light); text-decoration: none;">
                        {{ $name }}
                    </a>
                @else
                    <span style="color: var(--gold); font-weight: bold;">{{ $name }}</span>
                @endif
            @endforeach
        </div>

        <!-- Кнопка в админку для админов -->
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="navigate-item">
                    <span class="navigate-text">{{ __('messages.admin_panel') }}</span>
                </a>
            @endif
        @endauth
    </nav>
    @stack('scripts')
</header>