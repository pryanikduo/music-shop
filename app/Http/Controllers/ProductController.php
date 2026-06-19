<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($locale, $slug) // было: public function show($slug)
{
    $product = Product::where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();
        $product->load(['product_images', 'promotions', 'category']);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
    }
}