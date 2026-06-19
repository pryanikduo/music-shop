@extends('layouts.admin')
@section('title', 'Заказ #'.$order->order_number)
@section('content')
<div class="card">
    <div class="card-header"><h3>Заказ №{{ $order->order_number }}</h3></div>
    <div class="card-body">
        <p><strong>Покупатель:</strong> {{ $order->user->name ?? 'Гость' }}</p>
        <p><strong>Телефон:</strong> {{ $order->phone }}</p>
        <p><strong>Адрес доставки:</strong> {{ $order->delivery_address }}</p>
        <p><strong>Способ доставки:</strong> {{ $order->delivery_method ?? 'Не указан' }}</p>
        <p><strong>Способ оплаты:</strong> {{ $order->payment_method ?? 'Не указан' }}</p>
        <p><strong>Статус:</strong> {{ $order->status }}</p>
        <p><strong>Комментарий:</strong> {{ $order->comment ?: '—' }}</p>
        <hr>
        <h5>Товары в заказе:</h5>
        <table class="table table-sm">
            <thead><tr><th>Товар</th><th>Кол-во</th><th>Цена</th><th>Сумма</th></tr></thead>
            <tbody>
                @foreach($order->order_items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price_at_time, 2) }} руб.</td>
                    <td>{{ number_format($item->quantity * $item->price_at_time, 2) }} руб.</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h4>Итого: {{ number_format($order->total_price, 2) }} руб.</h4>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Назад</a>
    </div>
</div>
@endsection