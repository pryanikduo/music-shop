<div class="language-switcher" style="display: inline-flex; gap: 5px; align-items: center; margin-left: 15px;">
    <a href="{{ route('language.switch', 'ru') }}" style="text-decoration: none; color: {{ app()->getLocale() == 'ru' ? 'var(--gold)' : 'var(--light)' }}; font-weight: 500;">RU</a>
    <span style="color: var(--light);">|</span>
    <a href="{{ route('language.switch', 'en') }}" style="text-decoration: none; color: {{ app()->getLocale() == 'en' ? 'var(--gold)' : 'var(--light)' }}; font-weight: 500;">EN</a>
</div>