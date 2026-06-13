@extends('layouts.admin')

@section('title', 'Управление страницами')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Страницы сайта</h3>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">+ Добавить страницу</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Slug</th>
                    <th>Активна</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                <tr>
                    <td>{{ $page->page_id }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>{{ $page->is_active ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить страницу?')">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pages->links() }}
    </div>
</div>
@endsection