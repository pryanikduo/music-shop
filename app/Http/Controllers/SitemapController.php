<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\News;
use App\Models\Promotion;
use App\Models\Page;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        // Статические страницы
        $staticPages = [
            ['name' => 'Главная', 'url' => route('main')],
            ['name' => 'Каталог', 'url' => route('catalog')],
            ['name' => 'Новости и акции', 'url' => route('news')],
            ['name' => 'О нас', 'url' => route('about')],
            ['name' => 'Корзина', 'url' => route('cart.index')],
        ];

        // Динамические страницы из таблицы pages (например, история, контакты и т.д.)
        $customPages = Page::where('is_active', true)->get(['title', 'slug']);

        // Категории (только активные)
        $categories = Category::where('is_active', true)->get();

        // Товары (активные)
        $products = Product::where('is_active', true)->get();

        // Новости (активные)
        $news = News::where('is_active', true)->get();

        // Акции (активные)
        $promotions = Promotion::where('is_active', true)->get();

        return view('sitemap', compact(
            'staticPages',
            'customPages',
            'categories',
            'products',
            'news',
            'promotions'
        ));
    }
}