@extends('layouts.admin')
@section('title', 'Категории')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Категории товаров</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Добавить категорию</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr><th>ID</th><th>Название</th><th>Родитель</th><th>Тип</th><th>Порядок</th><th>Активна</th><th>Действия</th></tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->category_id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->category->name ?? '-' }}</td>
                    <td>{{ $cat->type }}</td>
                    <td>{{ $cat->sort_order }}</td>
                    <td>{{ $cat->is_active ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-warning">Ред</a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Уд</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>
@endsection