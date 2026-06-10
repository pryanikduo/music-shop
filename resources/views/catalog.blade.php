@include('layouts.head')
@section('title', 'Каталог музыкальных инструментов')
@include('layouts.menu')

<div class="catalog-container" style="max-width: 1200px; margin: 20px auto; padding: 0 15px;">
    <h1>Каталог музыкальных инструментов и аксессуаров</h1>

    <!-- Форма фильтрации -->
    <form method="GET" action="{{ route('catalog') }}" class="filters-form" style="display: flex; flex-wrap: wrap; gap: 15px; margin: 20px 0; padding: 15px; background: #f5f5f5; border-radius: 8px;">
        <div class="filter-group" style="flex: 1; min-width: 150px;">
            <label>Поиск:</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Название товара" style="width: 100%; padding: 6px;">
        </div>
        <div class="filter-group" style="min-width: 150px;">
            <label>Категория:</label>
            <select name="category" style="width: 100%; padding: 6px;">
                <option value="all">Все категории</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->category_id }}" {{ request('category') == $cat->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group" style="min-width: 120px;">
            <label>Цена от:</label>
            <input type="number" name="min_price" value="{{ request('min_price') }}" step="1" placeholder="0" style="width: 100%; padding: 6px;">
        </div>
        <div class="filter-group" style="min-width: 120px;">
            <label>Цена до:</label>
            <input type="number" name="max_price" value="{{ request('max_price') }}" step="1" placeholder="100000" style="width: 100%; padding: 6px;">
        </div>
        <div class="filter-group" style="min-width: 150px;">
            <label>Сортировка:</label>
            <select name="sort" style="width: 100%; padding: 6px;">
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена (по возрастанию)</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена (по убыванию)</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Название (А-Я)</option>
                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Название (Я-А)</option>
            </select>
        </div>
        <div class="filter-group" style="align-self: flex-end;">
            <button type="submit" style="padding: 8px 16px; background: #4f46e5; color: white; border: none; border-radius: 4px; cursor: pointer;">Применить</button>
            <a href="{{ route('catalog') }}" style="display: inline-block; margin-left: 10px; padding: 8px 16px; background: #ccc; color: black; text-decoration: none; border-radius: 4px;">Сбросить</a>
        </div>
    </form>

    <!-- Сетка товаров -->
    <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
        @forelse($products as $product)
            <!-- Вся карточка – ссылка на страницу товара -->
            <a href="{{ route('product.show', $product->slug) }}" class="product-card-link" style="text-decoration: none; color: inherit; display: block;">
                <div class="product-card" style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; background: #fff; transition: transform 0.2s;">
                    <div class="product-image" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                        @if($product->main_image)
                            <img src="{{ asset('img/' . $product->main_image) }}" alt="{{ $product->name }}" style="max-height: 100%; max-width: 100%;">
                        @else
                            <div style="width: 100%; height: 100%; background: #eee; display: flex; align-items: center; justify-content: center;">Нет фото</div>
                        @endif
                    </div>
                    <h3 style="font-size: 1.2rem; margin: 10px 0;">{{ $product->name }}</h3>
                    @if($product->has_discount)
                        <p style="text-decoration: line-through; color: #999;">{{ number_format($product->price, 2) }} руб.</p>
                        <p style="color: #e53e3e; font-weight: bold;">{{ number_format($product->discounted_price, 2) }} руб.</p>
                    @else
                        <p style="color: #e53e3e; font-weight: bold;">{{ number_format($product->price, 2) }} руб.</p>
                    @endif
                    <p>Остаток: {{ $product->stock }}</p>
                    <!-- Кнопка "В корзину" перехватывает клик, чтобы не переходить по ссылке -->
                    <form action="{{ route('cart.add', $product->product_id) }}" method="POST" onclick="event.stopPropagation();">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" style="background: #4f46e5; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">В корзину</button>
                    </form>
                </div>
            </a>
        @empty
            <div style="grid-column: 1/-1; text-align: center;">Товары не найдены.</div>
        @endforelse
    </div>

    <!-- Пагинация -->
    <div class="pagination" style="margin-top: 30px; display: flex; justify-content: center;">
        {{ $products->links() }}
    </div>
</div>

@include('layouts.footer')