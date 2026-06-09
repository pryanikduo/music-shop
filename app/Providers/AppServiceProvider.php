<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Listeners\MergeGuestCartListener;
use App\Services\CartService;
use Illuminate\Support\Facades\View;

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
    public function boot(): void
    {
        Event::listen(
            Login::class,
            MergeGuestCartListener::class
        );

        View::composer('*', function ($view) {
        $cartService = app(CartService::class);
        $view->with('cartCount', $cartService->getCartCount());
    });
    
    }
}
