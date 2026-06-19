@if($cart->isEmpty())
    <div class="cart-empty-message">
        <p>{{ __('messages.cart_empty') }} <a href="{{ route('catalog', ['locale' => app()->getLocale()]) }}" class="gold-link">{{ __('messages.go_to_catalog') }}</a></p>
    </div>
@else
    <div class="cart-items">
        @foreach($cart as $item)
            <div class="cart-item" id="cart-item-{{ $item->product->product_id }}">
                <div class="cart-item-image">
                    @if($item->product->main_image)
                        <img src="{{ asset('img/' . $item->product->main_image) }}" alt="{{ $item->product->name }}">
                    @else
                        <div class="no-image-placeholder">{{ __('messages.no_image') }}</div>
                    @endif
                </div>
                <div class="cart-item-info">
                    <h3>{{ $item->product->name }}</h3>
                    <p>{{ __('messages.price') }}: {{ number_format($item->product->price, 2) }} руб.</p>
                    <p class="stock-info">{{ __('messages.available') }}: {{ $item->product->stock }} шт.</p>
                </div>
                <div class="cart-item-quantity">
                    <input type="number" 
                           class="cart-quantity-input"
                           data-product-id="{{ $item->product->product_id }}"
                           data-update-url="{{ route('cart.update', ['locale' => app()->getLocale(), 'productId' => $item->product->product_id]) }}"
                           value="{{ $item->quantity }}" 
                           min="1" 
                           max="{{ $item->product->stock }}">
                </div>
                <div class="cart-item-total">
                    <strong id="item-total-{{ $item->product->product_id }}">{{ number_format($item->quantity * $item->product->price, 2) }} руб.</strong>
                </div>
                <div class="cart-item-remove">
                    <button class="remove-all-btn" data-product-id="{{ $item->product->product_id }}" 
                            data-remove-url="{{ route('cart.remove', ['locale' => app()->getLocale(), 'productId' => $item->product->product_id]) }}">
                        ✕ {{ __('messages.remove_all') }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="cart-summary">
        <h2>{{ __('messages.total') }}: <span id="cart-total">{{ number_format($total, 2) }}</span> руб.</h2>
        @auth
            <a href="{{ route('checkout', ['locale' => app()->getLocale()]) }}" class="checkout-btn">{{ __('messages.checkout') }}</a>
        @else
            <p>{!! __('messages.login_required') !!}</p>
        @endauth
    </div>
@endif

