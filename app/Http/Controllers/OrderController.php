<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function checkout()
    {
        $cart = $this->cartService->getCart();
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }
        $total = $this->cartService->getTotal();
        return view('checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'delivery_address' => 'required|string|max:500',
            'delivery_method'  => 'required|in:courier,pickup,post',
            'payment_method'   => 'required|in:cash,card,online',
            'phone'            => 'required|string|max:20',
            'email'            => 'required|email|max:255',
            'comment'          => 'nullable|string|max:1000',
        ]);

        $cart = $this->cartService->getCart();
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        $total = $this->cartService->getTotal();

        DB::beginTransaction();
        try {
            $orderNumber = 'ORD-' . strtoupper(uniqid());

            $order = Order::create([
                'user_id'           => auth()->id(),
                'order_number'      => $orderNumber,
                'status'            => 'new',
                'total_price'       => $total,
                'delivery_address'  => $validated['delivery_address'],
                'delivery_method'   => $validated['delivery_method'],
                'payment_method'    => $validated['payment_method'],
                'phone'             => $validated['phone'],
                'comment'           => $validated['comment'] ?? null,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'      => $order->order_id,
                    'product_id'    => $item->product_id,
                    'quantity'      => $item->quantity,
                    'price_at_time' => $item->product->price,
                ]);
            }

            $this->cartService->clearCart();

            DB::commit();

            return redirect()->route('cart.index')->with('success', "Заказ №{$orderNumber} успешно оформлен!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ошибка при оформлении заказа. Попробуйте позже.');
        }
    }
}