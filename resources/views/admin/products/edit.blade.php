@extends('layouts.admin')
@section('title', 'Редактировать товар')
@section('content')
<div class="card">
    <div class="card-header"><h3>Редактировать товар: {{ $product->name }}</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- все поля редактирования товара -->
            <div class="mb-3">
                <label>Категория</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->category_id }}" {{ $product->category_id == $cat->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label>Название</label><input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required></div>
            <div class="mb-3"><label>Название (английский)</label><input type="text" name="name_en" class="form-control" value="{{ old('name_en', $product->name_en) }}"></div>
            <div class="mb-3"><label>Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}" required></div>
            <div class="mb-3"><label>Цена</label><input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required></div>
            <div class="mb-3"><label>Остаток</label><input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required></div>
            <div class="mb-3"><label>Описание</label><textarea name="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea></div>
            <div class="mb-3"><label>Описание (английский)</label><textarea name="description_en" class="form-control" rows="5">{{ old('description_en', $product->description_en) }}</textarea></div>
            <div class="mb-3"><label>Главное изображение</label><input type="file" name="main_image" class="form-control">
                @if($product->main_image) <img src="{{ asset('storage/'.$product->main_image) }}" height="50"> @endif
            </div>
            <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}> <label>Активен</label></div>
            <button type="submit" class="btn btn-primary">Обновить товар</button>
        </form>
    </div>
</div>

<!-- Блок управления галереей -->
<div class="card mt-4">
    <div class="card-header"><h4>Галерея товара (карусель)</h4></div>
    <div class="card-body">
        <!-- Форма для добавления нового изображения -->
        <form action="{{ route('admin.products.images.store', $product) }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Добавить изображение</button>
                </div>
            </div>
        </form>

        <!-- Список существующих изображений -->
        <div id="gallery-list">
            @foreach($images as $img)
                <div class="gallery-item mb-3 p-2 border rounded d-flex align-items-center" data-id="{{ $img->img_id }}">
                    <div class="drag-handle me-3" style="cursor: move;">⋮⋮</div>
                    <img src="{{ asset('storage/'.$img->image_path) }}" style="height: 60px; width: auto;" class="me-3">
                    <div class="flex-grow-1">
                        <span class="badge bg-secondary">Порядок: {{ $img->sort_order }}</span>
                    </div>
                    <form action="{{ route('admin.products.images.destroy', $img) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить изображение?')">Удалить</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    var el = document.getElementById('gallery-list');
    var sortable = Sortable.create(el, {
        handle: '.drag-handle',
        onEnd: function() {
            let order = [];
            document.querySelectorAll('#gallery-list .gallery-item').forEach((item, idx) => {
                order.push(item.dataset.id);
            });
            fetch('{{ route("admin.products.images.order") }}', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            }).then(response => response.json()).then(data => {
                if(data.success) location.reload();
            });
        }
    });
</script>
@endpush