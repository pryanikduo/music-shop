@include('layouts.head')
@section('title', 'Каталог музыкальных инструментов')
@include('layouts.menu')

<div class="catalog-container">
    <h1>Каталог музыкальных инструментов и аксессуаров</h1>

    <form method="GET" action="{{ route('catalog') }}" class="filters-form">
        <div class="filter-group">
            <label>Поиск:</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Название товара">
        </div>
        <div class="filter-group">
            <label>Категория:</label>
            <select name="category">
                <option value="all">Все категории</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->category_id }}" {{ request('category') == $cat->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>Цена от:</label>
            <input type="number" name="min_price" value="{{ request('min_price') }}" step="1" placeholder="0">
        </div>
        <div class="filter-group">
            <label>Цена до:</label>
            <input type="number" name="max_price" value="{{ request('max_price') }}" step="1" placeholder="100000">
        </div>
        <div class="filter-group">
            <label>Сортировка:</label>
            <select name="sort">
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена (по возрастанию)</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена (по убыванию)</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Название (А-Я)</option>
                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Название (Я-А)</option>
            </select>
        </div>
        <div class="filter-group" style="align-self: flex-end;">
            <button type="submit">Применить</button>
            <a href="{{ route('catalog') }}">Сбросить</a>
        </div>
    </form>

    <div class="products-grid">
        @forelse($products as $product)
            <a href="{{ route('product.show', $product->slug) }}" class="product-card-link" style="text-decoration: none; color: inherit; display: block;">
                <div class="product-card">
                    <div class="product-image">
                        @if($product->main_image)
                            <img src="{{ asset('img/' . $product->main_image) }}" alt="{{ $product->name }}">
                        @else
                            <div style="width: 100%; height: 100%; background: #eee; display: flex; align-items: center; justify-content: center;">Нет фото</div>
                        @endif
                    </div>
                    <h3>{{ $product->name }}</h3>
                    @if($product->has_discount)
                        <div class="price">
                            <span class="old-price">{{ number_format($product->price, 2) }} руб.</span><br>
                            <span class="new-price">{{ number_format($product->discounted_price, 2) }} руб.</span>
                        </div>
                    @else
                        <div class="price"><span class="new-price">{{ number_format($product->price, 2) }} руб.</span></div>
                    @endif
                    <div class="stock">Остаток: {{ $product->stock }}</div>
                    <form action="{{ route('cart.add', $product->product_id) }}" method="POST" onclick="event.stopPropagation();">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit">В корзину</button>
                    </form>
                </div>
            </a>
        @empty
            <div style="grid-column: 1/-1; text-align: center;">Товары не найдены.</div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>

@include('layouts.footer')