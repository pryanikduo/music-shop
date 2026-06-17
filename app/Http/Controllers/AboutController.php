<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about($locale)
    {
        // Получаем страницу с историей
        $page = Page::where('slug', 'about')->where('is_active', true)->firstOrFail();

        // Получаем настройки контактов и карты
        $phone = Setting::where('key', 'contact_phone')->value('value');
        $email = Setting::where('key', 'contact_email')->value('value');
        $address = Setting::where('key', 'contact_address')->value('value');
        $map = Setting::where('key', 'google_maps_embed')->value('value');

        return view('about', compact('page', 'phone', 'email', 'address', 'map'));
    }
}