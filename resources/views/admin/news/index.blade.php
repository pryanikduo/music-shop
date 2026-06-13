@extends('layouts.admin')
@section('title', 'Новости')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Новости</h3>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Добавить новость</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr><th>ID</th><th>Заголовок</th><th>Дата публикации</th><th>Активна</th><th>Действия</th></tr>
            </thead>
            <tbody>
                @foreach($news as $item)
                <tr>
                    <td>{{ $item->news_id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->published_at)->format('d.m.Y H:i') }}</td>
                    <td>{{ $item->is_active ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning">Ред</a>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Уд</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $news->links() }}
    </div>
</div>
@endsection