@extends('layouts.admin')
@section('title', 'Добавить товар')
@section('content')
<div class="card">
    <div class="card-header"><h3>Добавить товар</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Категория</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->category_id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label>Название</label><input type="text" name="name" class="form-control" required></div>
            <div class="mb-3"><label>Название (английский)</label><input type="text" name="name_en" class="form-control"></div>
            <div class="mb-3"><label>Slug</label><input type="text" name="slug" class="form-control" required></div>
            <div class="mb-3"><label>Цена</label><input type="number" step="0.01" name="price" class="form-control" required></div>
            <div class="mb-3"><label>Остаток</label><input type="number" name="stock" class="form-control" required></div>
            <div class="mb-3"><label>Описание</label><textarea name="description" class="form-control" rows="5"></textarea></div>
            <div class="mb-3"><label>Описание (английский)</label><textarea name="description_en" class="form-control" rows="5"></textarea></div>
            <div class="mb-3"><label>Главное изображение</label><input type="file" name="main_image" class="form-control"></div>
            <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" value="1" checked> <label>Активен</label></div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>
@endsection