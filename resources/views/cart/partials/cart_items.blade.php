@if($cart->isEmpty())
    <div class="cart-empty-message">
        <p>Ваша корзина пуста. <a href="{{ route('catalog') }}" class="gold-link">Перейти в каталог</a></p>
    </div>
@else
    <div class="cart-items">
        @foreach($cart as $item)
            <div class="cart-item" id="cart-item-{{ $item->product->product_id }}">
                <div class="cart-item-image">
                    @if($item->product->main_image)
                        <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="{{ $item->product->name }}">
                    @else
                        <div class="no-image-placeholder">Нет фото</div>
                    @endif
                </div>
                <div class="cart-item-info">
                    <h3>{{ $item->product->name }}</h3>
                    <p>Цена: {{ number_format($item->product->price, 2) }} руб.</p>
                    <p class="stock-info">Доступно: {{ $item->product->stock }} шт.</p>
                </div>
                <div class="cart-item-quantity">
                    <input type="number" 
                           class="cart-quantity-input"
                           data-product-id="{{ $item->product->product_id }}"
                           value="{{ $item->quantity }}" 
                           min="1" 
                           max="{{ $item->product->stock }}">
                </div>
                <div class="cart-item-total">
                    <strong id="item-total-{{ $item->product->product_id }}">{{ number_format($item->quantity * $item->product->price, 2) }} руб.</strong>
                </div>
                <div class="cart-item-remove">
                    <button class="remove-all-btn" data-product-id="{{ $item->product->product_id }}">✕ Удалить все</button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="cart-summary">
        <h2>Итого: <span id="cart-total">{{ number_format($total, 2) }}</span> руб.</h2>
        @auth
            <a href="{{ route('checkout') }}" class="checkout-btn">Оформить заказ</a>
        @else
            <p>Для оформления заказа, пожалуйста, <a href="{{ route('login') }}" class="gold-link">войдите</a> или <a href="{{ route('register') }}" class="gold-link">зарегистрируйтесь</a>.</p>
        @endauth
    </div>
@endif

<style>
    /* небольшие доработки для пустого состояния */
    .cart-empty-message {
        text-align: center;
        padding: 60px 20px;
        background: var(--gray-bg);
        border-radius: 24px;
    }
    .gold-link {
        color: var(--gold);
        font-weight: 500;
        transition: var(--transition);
    }
    .gold-link:hover {
        color: var(--gold-light);
        text-decoration: underline;
    }
    .no-image-placeholder {
        width: 100%;
        height: 80px;
        background: #e0ddd5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        color: var(--dark);
    }
    .stock-info {
        font-size: 12px;
        color: #888;
        margin-top: 4px !important;
    }
</style>