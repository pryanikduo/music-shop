<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-col">
            <h3>О нас</h3>
            <ul>
                <li><a href="{{ route('about') }}">История</a></li>
                <li><a href="{{ route('about') }}">Контакты</a></li>
                <li><a href="{{ route('about') }}">Схема проезда</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Покупателям</h3>
            <ul>
                <li><a href="#">Доставка</a></li>
                <li><a href="{{ route('about') }}">Тех. поддержка</a></li>
                <li><a href="{{ route('about') }}">Обратная связь</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Популярное</h3>
            <ul>
                <li><a href="{{ route('catalog', ['search' => 'гитара']) }}">Гитары</a></li>
                <li><a href="{{ route('catalog', ['search' => 'пианино']) }}">Пианино</a></li>
                <li><a href="{{ route('catalog', ['search' => 'аксессуары']) }}">Аксессуары</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Контакты</h3>
            <ul>
                <li><p><strong>Телефон:</strong> {{ $contactPhone ?? '+7 (978) 123 45 67' }}</p></li>
                <li><p><strong>Email:</strong> {{ $contactEmail ?? 'nota@mail.ru' }}</p></li>
                <li><p><strong>Адрес:</strong> {{ $contactAddress ?? 'г. Москва, ул. Университетская, 33' }}</p></li>
                <li class="social-media">
                    <p>Наши соцсети:</p>
                    @if($socialVk)
                        <a href="{{ $socialVk }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/vk.svg') }}" alt="VK">
                        </a>
                    @endif
                    @if($socialTelegram)
                        <a href="{{ $socialTelegram }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/telegram.svg') }}" alt="Telegram">
                        </a>
                    @endif
                    @if($socialYoutube)
                        <a href="{{ $socialYoutube }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/youtube.svg') }}" alt="YouTube">
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Все права защищены</p>
        <p><a href="#">Карта сайта</a></p>
    </div>
</footer>