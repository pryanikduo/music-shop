<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Listeners\MergeGuestCartListener;
use App\Services\CartService;
use Illuminate\Support\Facades\View;
use App\Models\Category;    

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
    }
}
