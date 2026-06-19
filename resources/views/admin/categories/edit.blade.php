@extends('layouts.admin')
@section('title', 'Редактировать категорию')
@section('content')
<div class="card">
    <div class="card-header"><h3>Редактировать: {{ $category->name }}</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Родительская категория</label>
                <select name="parent_id" class="form-control">
                    <option value="">Нет (корневая)</option>
                    @foreach($parents as $p)
                        <option value="{{ $p->category_id }}" {{ $category->parent_id == $p->category_id ? 'selected' : '' }}>{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label>Название</label><input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required></div>
<div class="mb-3"><label>Название (английский)</label><input type="text" name="name_en" class="form-control" value="{{ old('name_en', $category->name_en) }}"></div>
            <div class="mb-3"><label>Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required></div>
            <div class="mb-3"><label>Тип</label>
                <select name="type" class="form-control">
                    <option value="instruments" {{ $category->type == 'instruments' ? 'selected' : '' }}>Инструменты</option>
                    <option value="accessories" {{ $category->type == 'accessories' ? 'selected' : '' }}>Аксессуары</option>
                </select>
            </div>
            <div class="mb-3"><label>Порядок сортировки</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order) }}"></div>
            <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $category->is_active ? 'checked' : '' }}> <label>Активна</label></div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
</div>
@endsection