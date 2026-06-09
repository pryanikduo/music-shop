@if($cart->isEmpty())
    <p>Ваша корзина пуста. <a href="{{ route('catalog') }}">Перейти в каталог</a></p>
@else
    <div class="cart-items">
        @foreach($cart as $item)
            <div class="cart-item" id="cart-item-{{ $item->product->product_id }}" style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 20px 0; gap: 20px;">
                <div class="cart-item-image" style="width: 100px;">
                    @if($item->product->main_image)
                        <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="{{ $item->product->name }}" style="max-width: 100%;">
                    @else
                        <div style="width: 100%; height: 80px; background: #eee; display: flex; align-items: center; justify-content: center;">Нет фото</div>
                    @endif
                </div>
                <div class="cart-item-info" style="flex: 2;">
                    <h3 style="margin: 0 0 5px;">{{ $item->product->name }}</h3>
                    <p style="margin: 0; color: #555;">Цена: {{ number_format($item->product->price, 2) }} руб.</p>
                    <p style="margin: 5px 0 0; font-size: 12px; color: #888;">Доступно: {{ $item->product->stock }} шт.</p>
                </div>
                <div class="cart-item-quantity" style="width: 180px;">
                    <input type="number" 
                           class="cart-quantity-input"
                           data-product-id="{{ $item->product->product_id }}"
                           value="{{ $item->quantity }}" 
                           min="1" 
                           max="{{ $item->product->stock }}" 
                           style="width: 80px; padding: 5px; text-align: center;">
                </div>
                <div class="cart-item-total" style="width: 120px; text-align: right;">
                    <strong id="item-total-{{ $item->product->product_id }}">{{ number_format($item->quantity * $item->product->price, 2) }} руб.</strong>
                </div>
                <div class="cart-item-remove">
                    <button class="remove-all-btn" data-product-id="{{ $item->product->product_id }}" style="background: #e53e3e; color: white; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer;">✕ Удалить все</button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="cart-summary" style="margin-top: 30px; padding: 20px; background: #f5f5f5; border-radius: 8px; text-align: right;">
        <h2>Итого: <span id="cart-total">{{ number_format($total, 2) }}</span> руб.</h2>
        @auth
            <a href="{{ route('checkout') }}" class="checkout-btn" style="display: inline-block; margin-top: 15px; background: #22c55e; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold;">Оформить заказ</a>
        @else
            <p style="margin-top: 15px;">Для оформления заказа, пожалуйста, <a href="{{ route('login') }}">войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>.</p>
        @endauth
    </div>
@endif