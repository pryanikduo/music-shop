<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    // Получить все позиции корзины
    public function getCart()
    {
        $query = $this->getCartQuery();
        return $query->with('product')->get(); // обязательно с product
    }

    // Количество товаров в корзине
    public function getCartCount()
    {
        return $this->getCartQuery()->sum('quantity');
    }

    // Добавить товар
    public function addProduct(Product $product, int $quantity = 1)
    {
        $query = $this->getCartQuery();
        $item = $query->where('product_id', $product->product_id)->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $data = [
                'product_id' => $product->product_id,
                'quantity' => $quantity,
            ];

            if (auth()->check()) {
                $data['user_id'] = auth()->id();
            } else {
                $data['session_id'] = Session::getId();
            }

            CartItem::create($data);
        }
    }

    // Обновить количество
    public function updateQuantity(Product $product, int $quantity)
    {
        if ($quantity < 1) {
            $quantity = 1;
        }
        if ($quantity > $product->stock) {
            $quantity = $product->stock;
        }

        $item = $this->getCartQuery()->where('product_id', $product->product_id)->first();
        if ($item) {
            if ($quantity <= 0) {
                $item->delete();
            } else {
                $item->update(['quantity' => $quantity]);
            }
        }
    }

    // Удалить товар
    public function removeProduct(Product $product)
    {
        $this->getCartQuery()->where('product_id', $product->product_id)->delete();
    }

    // Очистить корзину
    public function clearCart()
    {
        $this->getCartQuery()->delete();
    }

    // Получить общую сумму
    public function getTotal()
    {
        $items = $this->getCart();
        return $items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }

    // Вспомогательный метод для получения запроса
    private function getCartQuery()
    {
        if (auth()->check()) {
            return CartItem::where('user_id', auth()->id());
        } else {
            return CartItem::where('session_id', Session::getId());
        }
    }

    // Слияние гостевой корзины с пользовательской при входе
    public function mergeGuestCart()
    {
        if (!auth()->check()) return;

        $guestItems = CartItem::where('session_id', Session::getId())->get();
        foreach ($guestItems as $item) {
            $userItem = CartItem::where('user_id', auth()->id())
                ->where('product_id', $item->product_id)
                ->first();
            if ($userItem) {
                $userItem->increment('quantity', $item->quantity);
                $item->delete();
            } else {
                $item->update(['user_id' => auth()->id(), 'session_id' => null]);
            }
        }
    }
}