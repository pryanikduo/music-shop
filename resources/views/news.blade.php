@include('layouts.head')

@section('title', __('messages.news_title'))

@include('layouts.menu')
<body>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Блок НОВОСТИ -->
    <section class="news">
        <div class="container py-5">
            <h1>{{ __('messages.latest_news') }}</h1>
            <div class="row">
                @forelse($news as $item)
                <div class="col-10 col-lg-4 col-xl-3 my-4 m-0 m-auto">
                    <div class="card h-100">
                        <a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $item->slug]) }}" class="btn_sty">
                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </a>
                        <div class="news_date">
                            <h4>{{ \Carbon\Carbon::parse($item->published_at)->format('d m Y') }}</h4>
                        </div>
                        <img class="card-img-top" src="{{ asset($item->image ?? 'img/default_news.jpg') }}" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h3 class="card-title">{{ $item->title }}</h3>
                            <p class="card-text my-3">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">{{ __('messages.no_news') }}</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Блок АКЦИИ -->
    <section class="promotions" style="background-color: var(--gray-bg);">
        <div class="container py-5">
            <h1>{{ __('messages.promotions_and_discounts') }}</h1>
            <div class="row">
                @forelse($promotions as $promo)
                <div class="col-10 col-lg-4 col-xl-3 my-4 m-0 m-auto">
                    <div class="card h-100">
                        @if($promo->discount_percent)
                            <div class="discount-badge">-{{ $promo->discount_percent }}%</div>
                        @endif
                        <div class="news_date">
                            <h4>{{ \Carbon\Carbon::parse($promo->start_date)->format('d.m') }} – {{ \Carbon\Carbon::parse($promo->end_date)->format('d.m') }}</h4>
                        </div>
                        <img class="card-img-top" src="{{ asset($promo->image ?? 'img/default_promo.jpg') }}" alt="{{ $promo->title }}">
                        <div class="card-body">
                            <h3 class="card-title">{{ $promo->title }}</h3>
                            <p class="card-text my-3">{{ Str::limit($promo->description, 120) }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">{{ __('messages.no_promotions') }}</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Jumbotron -->
    <div class="jumbotron pb-4">
        <div class="container pb-5">
            <div class="row">
                <h4 class="text-center">
                    {{ __('messages.subscribe_text') }}
                </h4>
                <div class="col-12 col-lg-6 m-0 m-auto mt-4">
                    <form action="#" method="POST" class="text-center">
                        @csrf
                        <input type="email" name="subscribe_email" placeholder="{{ __('messages.subscribe_placeholder') }}" required>
                        <button type="submit">{{ __('messages.subscribe_button') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
@include('layouts.footer')