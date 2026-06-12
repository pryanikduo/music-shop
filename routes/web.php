<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SitemapController;

// Никакие административные контроллеры здесь не импортируются,
// чтобы избежать конфликта имён с пользовательскими.

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Используем полные имена классов без импорта (с ведущим слешем)
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');

    // Управление товарами
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    // Управление категориями
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    // Управление акциями
    Route::resource('promotions', \App\Http\Controllers\Admin\PromotionController::class);
    // Управление новостями
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    // Управление статическими страницами (pages)
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    // Заказы
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);
    // Сообщения обратной связи
    Route::resource('contact-messages', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);
    // Тикеты поддержки
    Route::resource('support-tickets', \App\Http\Controllers\Admin\SupportTicketController::class)->only(['index', 'show', 'update']);
    // Настройки сайта
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Загрузка изображений через редактор (TinyMCE)
    Route::post('upload-image', [\App\Http\Controllers\Admin\UploadController::class, 'uploadImage'])->name('upload.image');
});

// Пользовательские маршруты
Route::get('/', [MainController::class, 'main'])->name('main');
// Route::get('/', function () {
//     return view('main');
// })->name('home');

Route::get('/news', [NewsController::class, 'news'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/catalog', [CatalogController::class, 'catalog'])->name('catalog');

Route::get('/lang/{locale}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

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

Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');

require __DIR__.'/auth.php';