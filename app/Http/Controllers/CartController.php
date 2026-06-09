<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $this->cartService->addProduct($product, $request->input('quantity', 1));
        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function update(Request $request, Product $product)
    {
        $this->cartService->updateQuantity($product, $request->input('quantity'));
        return redirect()->route('cart.index');
    }

    public function remove(Product $product)
    {
        $this->cartService->removeProduct($product);
        return redirect()->route('cart.index');
    }
}