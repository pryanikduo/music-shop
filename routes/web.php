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
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========================================================
// АДМИНИСТРАТИВНЫЕ МАРШРУТЫ (без локализации)
// ========================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('promotions', \App\Http\Controllers\Admin\PromotionController::class);
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);
    Route::resource('contact-messages', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::resource('support-tickets', \App\Http\Controllers\Admin\SupportTicketController::class)->only(['index', 'show', 'update']);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'edit', 'update']);

    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    Route::post('upload-image', [\App\Http\Controllers\Admin\UploadController::class, 'uploadImage'])->name('upload.image');
    Route::post('products/{product}/images', [\App\Http\Controllers\Admin\ProductController::class, 'storeImage'])->name('products.images.store');
    Route::patch('products/images/order', [\App\Http\Controllers\Admin\ProductController::class, 'updateImageOrder'])->name('products.images.order');
    Route::delete('products/images/{image}', [\App\Http\Controllers\Admin\ProductController::class, 'destroyImage'])->name('products.images.destroy');
});

// ========================================================
// ПЕРЕКЛЮЧАТЕЛЬ ЯЗЫКА (вне группы локали)
// ========================================================
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// ========================================================
// ПОЛЬЗОВАТЕЛЬСКИЕ МАРШРУТЫ (с префиксом локали)
// ========================================================
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => 'ru|en'],
    'middleware' => 'setlocale'
], function () {
    // Главная
    Route::get('/', [MainController::class, 'main'])->name('main');

    // Новости
    Route::get('/news', [NewsController::class, 'news'])->name('news');
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

    // О нас
    Route::get('/about', [AboutController::class, 'about'])->name('about');

    // Каталог
    Route::get('/catalog', [CatalogController::class, 'catalog'])->name('catalog');

    // Товар
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

    // Корзина
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

    // Заказы
    Route::middleware('auth')->group(function () {
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    });

    // Профиль пользователя
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Обратная связь и техподдержка
    Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
    Route::post('/support', [App\Http\Controllers\SupportController::class, 'store'])->name('support.store');

    // Карта сайта
    Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');

    // Маршруты аутентификации (Breeze / Laravel UI)
    require __DIR__.'/auth.php';
});

// ========================================================
// РЕДИРЕКТ С КОРНЯ НА ЯЗЫК ПО УМОЛЧАНИЮ
// ========================================================
Route::get('/', function () {
    return redirect()->route('main', ['locale' => app()->getLocale()]);
});