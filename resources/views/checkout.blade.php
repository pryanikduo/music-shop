@include('layouts.head')
@section('title', __('messages.checkout_title'))
@include('layouts.menu')

<body>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <div class="container mt-5">
        <h1>{{ __('messages.checkout_title') }}</h1>

        <div class="row">
            <div class="col-md-5 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">{{ __('messages.your_cart') }}</span>
                    <span class="badge bg-secondary rounded-pill">{{ $cart->sum('quantity') }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($cart as $item)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">x{{ $item->quantity }}</small>
                            </div>
                            <span class="text-muted">{{ number_format($item->quantity * $item->product->price, 0, ',', ' ') }} ₽</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ __('messages.total') }}</span>
                        <strong>{{ number_format($total, 0, ',', ' ') }} ₽</strong>
                    </li>
                </ul>
            </div>

            <div class="col-md-7 order-md-1">
                <form action="{{ route('orders.store', ['locale' => app()->getLocale()]) }}" method="POST" id="orderForm">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('messages.email') }} *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('messages.phone') }} *</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="delivery_address" class="form-label">{{ __('messages.delivery_address') }} *</label>
                        <textarea class="form-control @error('delivery_address') is-invalid @enderror" id="delivery_address" name="delivery_address" rows="2" required>{{ old('delivery_address') }}</textarea>
                        @error('delivery_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.delivery_method') }} *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivery_method" id="delivery_courier" value="courier" {{ old('delivery_method') == 'courier' ? 'checked' : '' }}>
                            <label class="form-check-label" for="delivery_courier">{{ __('messages.courier') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivery_method" id="delivery_pickup" value="pickup" {{ old('delivery_method') == 'pickup' ? 'checked' : '' }}>
                            <label class="form-check-label" for="delivery_pickup">{{ __('messages.pickup') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivery_method" id="delivery_post" value="post" {{ old('delivery_method') == 'post' ? 'checked' : '' }}>
                            <label class="form-check-label" for="delivery_post">{{ __('messages.post') }}</label>
                        </div>
                        @error('delivery_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.payment_method') }} *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_cash" value="cash" {{ old('payment_method') == 'cash' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_cash">{{ __('messages.cash') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="card" {{ old('payment_method') == 'card' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_card">{{ __('messages.card') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_online" value="online" {{ old('payment_method') == 'online' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_online">{{ __('messages.online_payment') }}</label>
                        </div>
                        @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">{{ __('messages.comment') }}</label>
                        <textarea class="form-control" id="comment" name="comment" rows="2">{{ old('comment') }}</textarea>
                    </div>

                    <button type="submit" class="btn" style="background-color: #fede67; color: #323232; padding: 10px 30px;">{{ __('messages.confirm_order') }}</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('orderForm')?.addEventListener('submit', function(e) {
            let email = document.getElementById('email').value.trim();
            let phone = document.getElementById('phone').value.trim();
            let address = document.getElementById('delivery_address').value.trim();
            let delivery = document.querySelector('input[name="delivery_method"]:checked');
            let payment = document.querySelector('input[name="payment_method"]:checked');
            if (!email || !phone || !address || !delivery || !payment) {
                e.preventDefault();
                alert('{{ __('messages.fill_required_fields') }}');
            }
        });
    </script>
</body>

@include('layouts.footer')