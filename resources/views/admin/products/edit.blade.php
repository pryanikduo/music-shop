@extends('layouts.admin')
@section('title', 'Редактировать товар')
@section('content')
<div class="card">
    <div class="card-header"><h3>Редактировать товар: {{ $product->name }}</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Категория</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->category_id }}" {{ $product->category_id == $cat->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label>Название</label><input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required></div>
            <div class="mb-3"><label>Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}" required></div>
            <div class="mb-3"><label>Цена</label><input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required></div>
            <div class="mb-3"><label>Остаток</label><input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required></div>
            <div class="mb-3"><label>Описание</label><textarea name="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea></div>
            <div class="mb-3"><label>Главное изображение</label><input type="file" name="main_image" class="form-control">
                @if($product->main_image) <img src="{{ asset('storage/'.$product->main_image) }}" height="50"> @endif
            </div>
            <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}> <label>Активен</label></div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
</div>
@endsection