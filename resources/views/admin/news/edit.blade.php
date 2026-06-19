@extends('layouts.admin')
@section('title', 'Редактировать новость')
@section('content')
<div class="card">
    <div class="card-header"><h3>Редактировать: {{ $news->title }}</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3"><label>Заголовок</label><input type="text" name="title" class="form-control" value="{{ old('title', $news->title) }}" required></div>
            <div class="mb-3"><label>Заголовок (английский)</label><input type="text" name="title_en" class="form-control" value="{{ old('title_en', $news->title_en) }}"></div>
            <div class="mb-3"><label>Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $news->slug) }}" required></div>
            <div class="mb-3"><label>Содержание (полный текст)</label><textarea name="content" class="form-control tinymce" rows="10">{{ old('content', $news->content) }}</textarea></div>
            <div class="mb-3"><label>Содержание (английский)</label><textarea name="content_en" class="form-control tinymce" rows="10">{{ old('content_en', $news->content_en) }}</textarea></div>
            <div class="mb-3"><label>Изображение (превью)</label><input type="file" name="image" class="form-control"> @if($news->image) <img src="{{ asset('storage/'.$news->image) }}" height="50"> @endif</div>
            <div class="mb-3"><label>Дата публикации</label><input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', \Carbon\Carbon::parse($news->published_at)->format('Y-m-d\TH:i')) }}" required></div>
            <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $news->is_active ? 'checked' : '' }}> <label>Активна</label></div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
</div>
@endsection