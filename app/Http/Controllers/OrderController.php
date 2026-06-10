<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        // $this->middleware('auth');
        $this->cartService = $cartService;
    }

    public function checkout()
    {
        $cart = $this->cartService->getCart();
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }
        return view('orders.checkout', ['cart' => $cart, 'total' => $this->cartService->getTotal()]);
    }

    public function store(Request $request)
    {
        // Здесь будет логика создания заказа
        // Пока просто очищаем корзину и редиректим
        $this->cartService->clearCart();
        return redirect()->route('cart.index')->with('success', 'Заказ оформлен!');
    }
}