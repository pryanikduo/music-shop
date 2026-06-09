@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Корзина</h2>
            @if($cart->isEmpty())
                <p>Ваша корзина пуста.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr><th class="px-6 py-3 text-left">Товар</th><th>Цена</th><th>Количество</th><th>Сумма</th><th></th></tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                        <tr>
                            <td class="px-6 py-4">{{ $item->product->name }}</td>
                            <td class="px-6 py-4">{{ number_format($item->product->price, 2) }} руб.</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('cart.update', $item->product) }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-20 border rounded px-2 py-1">
                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Обновить</button>
                                </form>
                            </td>
                            <td class="px-6 py-4">{{ number_format($item->quantity * $item->product->price, 2) }} руб.</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('cart.remove', $item->product) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Удалить</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 text-xl font-bold">Итого: {{ number_format($total, 2) }} руб.</div>
                
                @auth
                    <a href="{{ route('checkout') }}" class="mt-4 inline-block bg-green-600 text-white px-6 py-2 rounded-lg">Оформить заказ</a>
                @else
                    <p class="mt-4 text-red-500">Для оформления заказа, пожалуйста, <a href="{{ route('login') }}" class="underline">войдите</a> или <a href="{{ route('register') }}" class="underline">зарегистрируйтесь</a>.</p>
                @endauth
            @endif
        </div>
    </div>
</div>
@endsection