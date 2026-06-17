@include('layouts.head')

@section('title', 'Главная страница')

@include('layouts.menu')
<body>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Start Home -->
    <section class="home" id="home">
        <div class="container pt-5 pt-lg-0">
            <div class="row">
                <div class="col-12 col-lg-5 m-0 m-auto pt-5 ms-lg-5">
                    <h2><i>2026</i></h2>
                    <h1 class="mx-2">Горячие предложения</h1>
                    <h4 class="mt-4 mb-2">Скидки до 20%</h4>
                    <a href="{{ route('catalog') }}" type="button" class="my-1 mt-5">Открыть</a>
                </div>
                <div class="col-12 col-lg-6 m-0 m-auto pt-5">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <ul class="carousel-indicators">
                            @foreach($sliderPromotions as $index => $promo)
                                <li data-bs-target="#carouselExampleControls" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ul>
                        <div class="carousel-inner">
                            @forelse($sliderPromotions as $index => $promo)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($promo->image ?? 'images/products/Home_1.png') }}" class="d-block w-100" alt="{{ $promo->title }}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $promo->title }}</h5>
                                        @if($promo->discount_percent)
                                            <p>Скидка {{ $promo->discount_percent }}%</p>
                                        @endif
                                    </div> -->
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <img src="images/products/Home_2.png" class="d-block w-100" alt="Slide 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/products/Home_1.png" class="d-block w-100" alt="Slide 2">
                                </div>
                            @endforelse
                        </div>
                        <button class="carousel-control-next carousel_buttons" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <ion-icon name="arrow-forward-circle-outline"></ion-icon>
                        </button>
                        <button class="carousel-control-prev carousel_buttons2" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <ion-icon name="arrow-back-circle-outline"></ion-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Home -->

    <!-- start new collection (динамические товары) -->
    <section class="collection" id="collection">
        <div class="container py-5">
            <div class="row">
                <h1 class="mt-5">Новые товары</h1>
                @foreach($newProducts as $product)
                    <div class="col-10 col-lg-3 m-0 m-auto sho_card my-5">
                        <div class="card">
                            <div class="card-text">
                                <h3 class="card-title mt-3 ms-3">{{ $product->name }}</h3>
                                <div class="btn_sty">
                                    <a href="{{ route('product.show', $product->slug) }}" type="button">Открыть</a>
                                </div>
                            </div>
                            <img src="{{ asset('img/' . $product->main_image ?? 'images/products/N_C_3.png') }}" alt="" class="card-image">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end new collection -->

    <!-- start best sellers (топ продаж) -->
    <section class="sellers" id="sellers">
        <div class="container py-5">
            <div class="row">
                <h1 class="mt-5">Топ продаж</h1>
                @foreach($topProducts as $product)
                    <div class="col-6 col-lg-3 my-5 m-0 m-auto">
                        <div class="card">
                            <div class="btn_sty">
                                <span class="me-3 hart_col">
                                    <ion-icon name="heart-outline" class="heart-outline"></ion-icon>
                                    <ion-icon name="heart" class="heart-filled"></ion-icon>
                                </span>
                            </div>
                            <div class="img_conta">
                                <img class="card-img-top" src="{{ asset('img/' . $product->main_image ?? 'images/products/Sellers_1.png') }}" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ number_format($product->price, 0, ',', ' ') }} ₽</p>
                                </div>
                                <div class="mt-2 bag_col add-to-cart" data-product-id="{{ $product->product_id }}">
                                    <ion-icon name="bag-add-outline" class="py-1 px-2 me-2 bag-outline"></ion-icon>
                                    <ion-icon name="bag-check-outline" class="py-1 px-2 me-2 bag-filled"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end best sellers -->

    <!-- Остальные блоки (статистика, бренды) пока закомментированы, оставляем как есть -->

</body>
@include('layouts.footer')

<script>
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            let productId = this.dataset.productId;
            if (!productId) return;

            fetch('{{ url("cart/add") }}/' + productId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',  // важный заголовок
                    'Accept': 'application/json'          // чтобы сервер понимал, что нужен JSON
                },
                body: JSON.stringify({ quantity: 1 })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Сервер вернул ошибку ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Товар добавлен в корзину');
                    let cartCountElem = document.querySelector('.cart-count');
                    if (cartCountElem && data.cart_count !== undefined) {
                        cartCountElem.innerText = data.cart_count;
                    }
                } else if (data.error) {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Не удалось добавить товар');
            });
        });
    });
</script>