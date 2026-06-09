@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Оформление заказа</h2>
            <p>Содержимое вашей корзины:</p>
            <ul>
                @foreach($cart as $item)
                    <li>{{ $item->product->name }} x {{ $item->quantity }} = {{ $item->quantity * $item->product->price }} руб.</li>
                @endforeach
            </ul>
            <p class="font-bold">Итого: {{ $total }} руб.</p>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 rounded">Подтвердить заказ</button>
            </form>
        </div>
    </div>
</div>
@endsection