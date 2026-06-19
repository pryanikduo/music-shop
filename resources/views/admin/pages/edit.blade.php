@extends('layouts.admin')

@section('title', 'Редактировать страницу')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Редактировать страницу: {{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $page->slug) }}" required>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Заголовок (русский)</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $page->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="title_en" class="form-label">Заголовок (английский)</label>
                <input type="text" name="title_en" id="title_en" class="form-control" value="{{ old('title_en', $page->title_en) }}">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Содержание (русский, HTML)</label>
                <textarea name="content" id="content" class="form-control tinymce" rows="15">{{ old('content', $page->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="content_en" class="form-label">Содержание (английский, HTML)</label>
                <textarea name="content_en" id="content_en" class="form-control tinymce" rows="15">{{ old('content_en', $page->content_en) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description (русский)</label>
                <textarea name="meta_description" id="meta_description" class="form-control" rows="2">{{ old('meta_description', $page->meta_description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="meta_description_en" class="form-label">Meta Description (английский)</label>
                <textarea name="meta_description_en" id="meta_description_en" class="form-control" rows="2">{{ old('meta_description_en', $page->meta_description_en) }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="form-check-label">Активна</label>
            </div>

            <button type="submit" class="btn btn-primary">Обновить</button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/4ldrwsoc32l3rhrnyo96h4zhx8cnwf9n77657tuf5wsi8w86/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        height: 500,
        menubar: true,
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link | code | help',
        images_upload_url: '{{ route("admin.upload.image") }}',
        images_upload_credentials: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        relative_urls: false,
        remove_script_host: false,
        convert_urls: false,
    });
</script>
@endpush