<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');
        if (in_array($locale, ['ru', 'en'])) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
        } else {
            app()->setLocale(config('app.fallback_locale'));
        }
        
        return $next($request);
    }
}