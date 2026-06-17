<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-col">
            <h3>{{ __('messages.about_us_footer') }}</h3>
            <ul>
                <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('messages.history') }}</a></li>
                <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('messages.contacts_footer') }}</a></li>
                <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('messages.map_footer') }}</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>{{ __('messages.for_customers') }}</h3>
            <ul>
                <li><a href="#">{{ __('messages.delivery') }}</a></li>
                <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('messages.support_footer') }}</a></li>
                <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('messages.feedback_footer') }}</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>{{ __('messages.popular') }}</h3>
            <ul>
                <li><a href="{{ route('catalog', ['locale' => app()->getLocale(), 'search' => 'гитара']) }}">{{ __('messages.guitars') }}</a></li>
                <li><a href="{{ route('catalog', ['locale' => app()->getLocale(), 'search' => 'пианино']) }}">{{ __('messages.pianos') }}</a></li>
                <li><a href="{{ route('catalog', ['locale' => app()->getLocale(), 'search' => 'аксессуары']) }}">{{ __('messages.accessories') }}</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>{{ __('messages.contacts_footer') }}</h3>
            <ul>
                <li><p><strong>{{ __('messages.phone_footer') }}:</strong> {{ $contactPhone ?? '+7 (978) 123 45 67' }}</p></li>
                <li><p><strong>{{ __('messages.email_footer') }}:</strong> {{ $contactEmail ?? 'nota@mail.ru' }}</p></li>
                <li><p><strong>{{ __('messages.address_footer') }}:</strong> {{ $contactAddress ?? 'г. Москва, ул. Университетская, 33' }}</p></li>
                <li class="social-media">
                    <p>{{ __('messages.social_media') }}</p>
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
        <p>© {{ date('Y') }} {{ __('messages.all_rights_reserved') }}</p>
        <p><a href="{{ route('sitemap', ['locale' => app()->getLocale()]) }}">{{ __('messages.sitemap_footer') }}</a></p>
    </div>
</footer>