<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getCart()
    {
        if (auth()->check()) {
            return CartItem::where('user_id', auth()->id())->with('product')->get();
        } else {
            return CartItem::where('session_id', Session::getId())->with('product')->get();
        }
    }

    public function getCartCount()
    {
        if (auth()->check()) {
            return CartItem::where('user_id', auth()->id())->sum('quantity');
        } else {
            return CartItem::where('session_id', Session::getId())->sum('quantity');
        }
    }

    public function addProduct(Product $product, int $quantity = 1)
    {
        $cartQuery = $this->getCartQuery();
        $item = $cartQuery->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $cartQuery->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }
    }

    public function updateQuantity(Product $product, int $quantity)
    {
        $item = $this->getCartQuery()->where('product_id', $product->id)->first();
        if ($item) {
            if ($quantity <= 0) {
                $item->delete();
            } else {
                $item->update(['quantity' => $quantity]);
            }
        }
    }

    public function removeProduct(Product $product)
    {
        $this->getCartQuery()->where('product_id', $product->id)->delete();
    }

    public function clearCart()
    {
        $this->getCartQuery()->delete();
    }

    public function getTotal()
    {
        return $this->getCart()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }

    private function getCartQuery()
    {
        if (auth()->check()) {
            return CartItem::where('user_id', auth()->id());
        } else {
            return CartItem::where('session_id', Session::getId());
        }
    }

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
            } else {
                $item->update(['user_id' => auth()->id(), 'session_id' => null]);
            }
        }
        // Удаляем записи, которые остались с session_id (если были не обновлены)
        CartItem::where('session_id', Session::getId())->whereNull('user_id')->delete();
    }
}