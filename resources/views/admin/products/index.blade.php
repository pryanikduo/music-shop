@extends('layouts.admin')
@section('title', 'Товары')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Товары</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Добавить товар</a>
    </div>
    <div class="card-body">
         <table class="table table-bordered">
            <thead>
                <tr><th>ID</th><th>Название</th><th>Категория</th><th>Цена</th><th>Остаток</th><th>Активен</th><th>Действия</th></tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->is_active ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Ред</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Уд</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
@endsection