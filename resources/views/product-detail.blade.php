@include('layouts.head')
@section('title', $product->name)
@include('layouts.menu')

<body>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <div class="container mt-5">
        <div class="row">
            <!-- Галерея (слайдшоу) -->
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php $images = $product->product_images->isEmpty() ? collect([(object)['image_path' => $product->main_image]]) : $product->product_images; @endphp
                        @foreach($images as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('img/' . $image->image_path ?? $product->main_image) }}" class="d-block w-100" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Информация о товаре -->
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                @if($product->has_discount)
                    <p class="text-muted" style="text-decoration: line-through;">{{ number_format($product->price, 0, ',', ' ') }} ₽</p>
                    <h2 class="text-danger">{{ number_format($product->discounted_price, 0, ',', ' ') }} ₽</h2>
                    <span class="badge bg-danger">-{{ $product->active_promotion->discount_percent }}%</span>
                @else
                    <h2>{{ number_format($product->price, 0, ',', ' ') }} ₽</h2>
                @endif

                <p class="mt-3"><strong>В наличии:</strong> {{ $product->stock > 0 ? $product->stock . ' шт.' : 'Нет в наличии' }}</p>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Количество</label>
                    <input type="number" id="quantity" class="form-control" style="width: 100px;" value="1" min="1" max="{{ $product->stock }}">
                </div>

                <button id="add-to-cart-btn" class="btn" style="background-color: #fede67; color: #323232; padding: 10px 24px;" data-product-id="{{ $product->product_id }}">
                    <ion-icon name="bag-add-outline"></ion-icon> Добавить в корзину
                </button>

                <hr>
                <h4>Описание</h4>
                <div>{!! $product->description !!}</div>

                @if($product->promotions->count() > 0)
                    <hr>
                    <h4>Акции на товар</h4>
                    <ul>
                        @foreach($product->promotions as $promo)
                            <li>{{ $promo->title }} @if($promo->discount_percent) (скидка {{ $promo->discount_percent }}%) @endif</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Блок похожих товаров (опционально) -->
        @if($relatedProducts->count())
        <div class="row mt-5">
            <h3>Похожие товары</h3>
            @foreach($relatedProducts as $rel)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('img/' . $rel->main_image ?? 'img/default_product.jpg') }}" class="card-img-top" alt="{{ $rel->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $rel->name }}</h5>
                            <p class="card-text">{{ number_format($rel->price, 0, ',', ' ') }} ₽</p>
                            <a href="{{ route('product.show', $rel->slug) }}" class="btn btn-sm" style="background-color: #fede67;">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>

    <script>
        document.getElementById('add-to-cart-btn')?.addEventListener('click', function() {
            let productId = this.dataset.productId;
            let quantity = document.getElementById('quantity').value;
            fetch('{{ url("cart/add") }}/' + productId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Товар добавлен в корзину');
                    let cartCountElem = document.querySelector('.cart-count');
                    if (cartCountElem) cartCountElem.innerText = data.cart_count;
                } else {
                    alert(data.error || 'Ошибка');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Не удалось добавить товар');
            });
        });
    </script>
</body>

@include('layouts.footer')