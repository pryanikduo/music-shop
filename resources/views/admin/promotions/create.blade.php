@extends('layouts.admin')
@section('title', 'Добавить акцию')
@section('content')
<div class="card">
    <div class="card-header"><h3>Новая акция</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.promotions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3"><label>Название</label><input type="text" name="title" class="form-control" required></div>
            <div class="mb-3"><label>Slug</label><input type="text" name="slug" class="form-control" required></div>
            <div class="mb-3"><label>Описание (краткое)</label><textarea name="description" class="form-control" rows="3"></textarea></div>
            <div class="mb-3"><label>Скидка (%)</label><input type="number" name="discount_percent" class="form-control" min="0" max="100"></div>
            <div class="mb-3"><label>Дата начала</label><input type="date" name="start_date" class="form-control" required></div>
            <div class="mb-3"><label>Дата окончания</label><input type="date" name="end_date" class="form-control" required></div>
            <div class="mb-3"><label>Изображение (баннер)</label><input type="file" name="image" class="form-control"></div>
            <div class="mb-3 form-check"><input type="checkbox" name="show_on_slider" class="form-check-input" value="1"> <label>Показывать на слайдере главной</label></div>
            <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" value="1" checked> <label>Активна</label></div>
            <div class="mb-3"><label>Товары, участвующие в акции</label>
                <select name="products[]" multiple class="form-control" size="8">
                    @foreach($products as $prod)
                        <option value="{{ $prod->product_id }}">{{ $prod->name }} ({{ number_format($prod->price,2) }} руб.)</option>
                    @endforeach
                </select>
                <small>Удерживайте Ctrl для множественного выбора</small>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>
@endsection