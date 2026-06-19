<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Promotion;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Страница со списком новостей и акций
    public function news()
    {
        // Активные новости, от свежих к старым
        $news = News::where('is_active', true)
                    ->orderBy('published_at', 'desc')
                    ->get();

        // Активные акции (текущая дата в периоде)
        $today = now()->toDateString();
        $promotions = Promotion::where('is_active', true)
                               ->where('start_date', '<=', $today)
                               ->where('end_date', '>=', $today)
                               ->orderBy('start_date', 'desc')
                               ->get();

        return view('news', compact('news', 'promotions'));
    }

    // Детальная страница новости
    public function show($locale, $slug) // было: public function show($slug)
    {
        $news = News::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return view('news-detail', compact('news'));
    }
}