@extends('layouts.admin')
@section('title', 'Добавить новость')
@section('content')
<div class="card">
    <div class="card-header"><h3>Новая новость</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3"><label>Заголовок</label><input type="text" name="title" class="form-control" required></div>
            <div class="mb-3"><label>Slug</label><input type="text" name="slug" class="form-control" required></div>
            <div class="mb-3"><label>Содержание (полный текст)</label><textarea name="content" class="form-control tinymce" rows="10"></textarea></div>
            <div class="mb-3"><label>Изображение (превью)</label><input type="file" name="image" class="form-control"></div>
            <div class="mb-3"><label>Дата публикации</label><input type="datetime-local" name="published_at" class="form-control" required></div>
            <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" value="1" checked> <label>Активна</label></div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>
@endsection