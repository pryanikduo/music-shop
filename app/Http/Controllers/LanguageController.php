<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        if (!in_array($locale, ['ru', 'en'])) {
            $locale = config('app.fallback_locale');
        }

        session()->put('locale', $locale);

        // Редирект на предыдущую страницу или на главную с новой локалью
        $previousUrl = url()->previous();
        // Если предыдущий URL содержит локаль, заменяем её, иначе добавляем
        $parsed = parse_url($previousUrl);
        $path = $parsed['path'] ?? '/';
        // Удаляем возможный префикс локали из пути
        $segments = explode('/', trim($path, '/'));
        if (in_array($segments[0] ?? '', ['ru', 'en'])) {
            array_shift($segments);
        }
        $newPath = '/' . $locale . '/' . implode('/', $segments);
        // Если путь пустой или '/', то просто '/'
        if ($newPath == '/' . $locale . '/') {
            $newPath = '/' . $locale;
        }

        return redirect($newPath);
    }
}