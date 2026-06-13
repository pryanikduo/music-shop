@extends('layouts.admin')
@section('title', 'Редактировать акцию')
@section('content')
<div class="card">
    <div class="card-header"><h3>Редактировать: {{ $promotion->title }}</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.promotions.update', $promotion) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3"><label>Название</label><input type="text" name="title" class="form-control" value="{{ old('title', $promotion->title) }}" required></div>
            <div class="mb-3"><label>Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $promotion->slug) }}" required></div>
            <div class="mb-3"><label>Описание (краткое)</label><textarea name="description" class="form-control" rows="3">{{ old('description', $promotion->description) }}</textarea></div>
            <div class="mb-3"><label>Скидка (%)</label><input type="number" name="discount_percent" class="form-control" value="{{ old('discount_percent', $promotion->discount_percent) }}" min="0" max="100"></div>
            <div class="mb-3"><label>Дата начала</label><input type="date" name="start_date" class="form-control" value="{{ old('start_date', $promotion->start_date->format('Y-m-d')) }}" required></div>
            <div class="mb-3"><label>Дата окончания</label><input type="date" name="end_date" class="form-control" value="{{ old('end_date', $promotion->end_date->format('Y-m-d')) }}" required></div>
            <div class="mb-3"><label>Изображение (баннер)</label><input type="file" name="image" class="form-control"> @if($promotion->image) <img src="{{ asset('storage/'.$promotion->image) }}" height="50"> @endif</div>
            <div class="mb-3 form-check"><input type="checkbox" name="show_on_slider" class="form-check-input" value="1" {{ $promotion->show_on_slider ? 'checked' : '' }}> <label>Показывать на слайдере главной</label></div>
            <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $promotion->is_active ? 'checked' : '' }}> <label>Активна</label></div>
            <div class="mb-3"><label>Товары, участвующие в акции</label>
                <select name="products[]" multiple class="form-control" size="8">
                    @foreach($products as $prod)
                        <option value="{{ $prod->product_id }}" {{ $promotion->products->contains($prod->product_id) ? 'selected' : '' }}>{{ $prod->name }} ({{ number_format($prod->price,2) }} руб.)</option>
                    @endforeach
                </select>
                <small>Удерживайте Ctrl для множественного выбора</small>
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
</div>
@endsection