<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main()
    {
        $today = now()->toDateString();
        $sliderPromotions = Promotion::where('is_active', true)
            ->where('show_on_slider', true)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        $newProducts = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Просто берём любые 4 товара для блока "Топ продаж"
        $topProducts = Product::where('is_active', true)
            ->limit(4)
            ->get();

        return view('main', compact('sliderPromotions', 'newProducts', 'topProducts'));
    }
}