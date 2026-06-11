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

    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Товар не найден'], 404);
            }
            return redirect()->back()->with('error', 'Товар не найден');
        }
        $this->cartService->addProduct($product, $request->input('quantity', 1));
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Товар добавлен',
                'cart_count' => $this->cartService->getCartCount()
            ]);
        }
        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function update(Request $request, $productId)
{
    $product = Product::find($productId);
    if (!$product) {
        return response()->json(['error' => 'Товар не найден'], 404);
    }

    $quantity = (int) $request->input('quantity', 1);
    // Ограничиваем количество
    if ($quantity < 1) $quantity = 1;
    if ($quantity > $product->stock) $quantity = $product->stock;

    $this->cartService->updateQuantity($product, $quantity);

    // Получаем обновлённую корзину
    $cart = $this->cartService->getCart();
    $total = $this->cartService->getTotal();
    $updatedItem = $cart->firstWhere('product_id', $product->product_id);
    $itemTotal = $updatedItem ? $updatedItem->quantity * $updatedItem->product->price : 0;

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'item_total' => number_format($itemTotal, 2),
            'total' => number_format($total, 2),
            'cart_count' => $this->cartService->getCartCount(),
            'quantity' => $updatedItem ? $updatedItem->quantity : 0,
            'stock' => $product->stock,
            'product_id' => $product->product_id,
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Количество обновлено');
}

    public function remove(Request $request, $productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $this->cartService->removeProduct($product);
        }

        $total = $this->cartService->getTotal();
        $cartCount = $this->cartService->getCartCount();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'total' => number_format($total, 2),
                'cart_count' => $cartCount,
                'cart_empty' => $cartCount == 0
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Товар удалён');
    }
}