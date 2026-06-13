@extends('layouts.admin')

@section('title', 'Создать страницу')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Создать новую страницу</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="slug" class="form-label">Slug (уникальный идентификатор, латиницей)</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                <small class="text-muted">Пример: about, delivery, contacts</small>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Заголовок страницы</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Содержание страницы (HTML)</label>
                <textarea name="content" id="content" class="form-control tinymce" rows="15">{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                <textarea name="meta_description" id="meta_description" class="form-control" rows="2">{{ old('meta_description') }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active" class="form-check-label">Активна</label>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
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