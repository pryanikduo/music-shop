@extends('layouts.admin')
@section('title', 'Акции')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Акции и скидки</h3>
        <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary">+ Добавить акцию</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr><th>ID</th><th>Название</th><th>Скидка %</th><th>Период</th><th>Слайдер</th><th>Активна</th><th>Действия</th></tr>
            </thead>
            <tbody>
                @foreach($promotions as $promo)
                <tr>
                    <td>{{ $promo->promotion_id }}</td>
                    <td>{{ $promo->title }}</td>
                    <td>{{ $promo->discount_percent ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($promo->start_date)->format('d.m.Y') }} – {{ \Carbon\Carbon::parse($promo->end_date)->format('d.m.Y') }}</td>
                    <td>{{ $promo->show_on_slider ? 'Да' : 'Нет' }}</td>
                    <td>{{ $promo->is_active ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('admin.promotions.edit', $promo) }}" class="btn btn-sm btn-warning">Ред</a>
                        <form action="{{ route('admin.promotions.destroy', $promo) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Уд</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $promotions->links() }}
    </div>
</div>
@endsection