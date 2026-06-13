@extends('layouts.admin')
@section('title', 'Заказы')
@section('content')
<div class="card">
    <div class="card-header"><h3>Список заказов</h3></div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr><th>№ заказа</th><th>Покупатель</th><th>Телефон</th><th>Сумма</th><th>Статус</th><th>Дата</th><th>Действия</th></tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->user->name ?? 'Гость' }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ number_format($order->total_price, 2) }} руб.</td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="d-inline">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>Новый</option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Оплачен</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Отправлен</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Отменён</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">Детали</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
@endsection