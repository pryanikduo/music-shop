<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProfileController;

Route::get('/', [MainController::class, 'main'])->name('main');
Route::get('/', function () {
    return view('main');
})->name('home');
// Детальная страница новости (должна быть после общего маршрута /news, но до /news/{slug})
Route::get('/news', [NewsController::class, 'news'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/catalog', [CatalogController::class, 'catalog'])->name('catalog');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Обратная связь и техподдержка
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::post('/support', [App\Http\Controllers\SupportController::class, 'store'])->name('support.store');

require __DIR__.'/auth.php';