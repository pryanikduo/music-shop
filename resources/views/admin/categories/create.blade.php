@extends('layouts.admin')
@section('title', 'Добавить категорию')
@section('content')
<div class="card">
    <div class="card-header"><h3>Новая категория</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Родительская категория</label>
                <select name="parent_id" class="form-control">
                    <option value="">Нет (корневая)</option>
                    @foreach($parents as $p)
                        <option value="{{ $p->category_id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label>Название</label><input type="text" name="name" class="form-control" required></div>
            <div class="mb-3"><label>Название (английский)</label><input type="text" name="name_en" class="form-control"></div>
            <div class="mb-3"><label>Slug</label><input type="text" name="slug" class="form-control" required></div>
            <div class="mb-3"><label>Тип</label>
                <select name="type" class="form-control">
                    <option value="instruments">Инструменты</option>
                    <option value="accessories">Аксессуары</option>
                </select>
            </div>
            <div class="mb-3"><label>Порядок сортировки</label><input type="number" name="sort_order" class="form-control" value="0"></div>
            <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" value="1" checked> <label>Активна</label></div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>
@endsection