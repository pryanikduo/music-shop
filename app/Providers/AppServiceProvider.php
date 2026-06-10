<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Listeners\MergeGuestCartListener;
use App\Services\CartService;
use Illuminate\Support\Facades\View;
use App\Models\Category;    
use App\Models\Setting;    

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.menu', function ($view) {
            $categories = Category::with('categories')
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->get();
            $view->with('menuCategories', $categories);
        });
        View::composer('layouts.footer', function ($view) {
            $view->with([
                'contactPhone' => Setting::getValue('contact_phone'),
                'contactEmail' => Setting::getValue('contact_email'),
                'contactAddress' => Setting::getValue('contact_address'),
                'socialVk' => Setting::getValue('social_vk'),
                'socialTelegram' => Setting::getValue('social_telegram'),
                'socialYoutube' => Setting::getValue('social_youtube'),
            ]);
        });
    }
}
