<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function catalog($locale, Request $request)
    {
        $query = Product::where('is_active', true)->with('category');

        // Поиск по названию
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Фильтр по категории (включая подкатегории)
        if ($request->filled('category') && $request->category != 'all') {
            $category = Category::find($request->category);
            if ($category) {
                $categoryIds = $category->getDescendantIds(); // включает текущую и всех потомков
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // Фильтр по цене
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Сортировка
        $sort = $request->input('sort', 'price_asc');
        switch ($sort) {
            case 'price_asc': $query->orderBy('price', 'asc'); break;
            case 'price_desc': $query->orderBy('price', 'desc'); break;
            case 'name_asc': $query->orderBy('name', 'asc'); break;
            case 'name_desc': $query->orderBy('name', 'desc'); break;
            default: $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(12)->withQueryString();

        // Список категорий для фильтра (можно оставить для формы фильтрации)
        $categories = Category::orderBy('name')->get();

        return view('catalog', compact('products', 'categories'));
    }
}