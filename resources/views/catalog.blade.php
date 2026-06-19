@include('layouts.head')
@section('title', __('messages.catalog_title'))
@include('layouts.menu')

<div class="catalog-container">
    <h1>{{ __('messages.catalog_title') }}</h1>

    <form method="GET" action="{{ route('catalog', ['locale' => app()->getLocale()]) }}" class="filters-form">
        <div class="filter-group">
            <label>{{ __('messages.search') }}:</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.search') }}">
        </div>
        <div class="filter-group">
            <label>{{ __('messages.category') }}:</label>
            <select name="category">
                <option value="all">{{ __('messages.all_categories') }}</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->category_id }}" {{ request('category') == $cat->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>{{ __('messages.price_from') }}:</label>
            <input type="number" name="min_price" value="{{ request('min_price') }}" step="1" placeholder="0">
        </div>
        <div class="filter-group">
            <label>{{ __('messages.price_to') }}:</label>
            <input type="number" name="max_price" value="{{ request('max_price') }}" step="1" placeholder="100000">
        </div>
        <div class="filter-group">
            <label>{{ __('messages.sort') }}:</label>
            <select name="sort">
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>{{ __('messages.sort_price_asc') }}</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>{{ __('messages.sort_price_desc') }}</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>{{ __('messages.sort_name_asc') }}</option>
                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>{{ __('messages.sort_name_desc') }}</option>
            </select>
        </div>
        <div class="filter-group" style="align-self: flex-end;">
            <button type="submit">{{ __('messages.apply') }}</button>
            <a href="{{ route('catalog', ['locale' => app()->getLocale()]) }}">{{ __('messages.reset') }}</a>
        </div>
    </form>

    <div class="products-grid">
        @forelse($products as $product)
            <a href="{{ route('product.show', ['locale' => app()->getLocale(), 'slug' => $product->slug]) }}" class="product-card-link" style="text-decoration: none; color: inherit; display: block;">
                <div class="product-card">
                    @php
                        $imagePath = $product->main_image ?? null;
                        if ($imagePath) {
                            if (str_starts_with($imagePath, 'img/')) {
                                $imageUrl = asset($imagePath);
                            } elseif (str_starts_with($imagePath, 'products/') || str_starts_with($imagePath, 'storage/')) {
                                $imageUrl = Storage::url($imagePath);
                            } else {
                                // Старый формат: просто имя файла, лежит в public/img
                                $imageUrl = asset('img/' . $imagePath);
                            }
                        } else {
                            $imageUrl = asset('img/default_product.jpg');
                        }
                    @endphp
                    <div class="product-image">
                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                        <!-- <div style="width: 100%; height: 100%; background: #eee; display: flex; align-items: center; justify-content: center;">{{ __('messages.no_image') }}</div> -->
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
                    <div class="stock">{{ __('messages.stock') }}: {{ $product->stock }}</div>
                    <form action="{{ route('cart.add', ['locale' => app()->getLocale(), 'productId' => $product->product_id]) }}" method="POST" onclick="event.stopPropagation();">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit">{{ __('messages.add_to_cart') }}</button>
                    </form>
                </div>
            </a>
        @empty
            <div style="grid-column: 1/-1; text-align: center;">{{ __('messages.no_products_found') }}</div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>

@include('layouts.footer')