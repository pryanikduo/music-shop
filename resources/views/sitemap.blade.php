@include('layouts.head')
@section('title', 'Карта сайта')
@include('layouts.menu')

<body>
    <div class="container mt-5">
        <h1>Карта сайта</h1>
        <div class="row">
            <!-- Статические страницы -->
            <div class="col-md-6">
                <h3>Основные разделы</h3>
                <ul>
                    @foreach($staticPages as $page)
                        <li><a href="{{ $page['url'] }}">{{ $page['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Информационные страницы из БД (только те, у которых slug = 'about') -->
            @php $aboutPage = $customPages->where('slug', 'about')->first(); @endphp
            @if($aboutPage)
            <div class="col-md-6">
                <h3>Информация</h3>
                <ul>
                    <li><a href="{{ route('about') }}">{{ $aboutPage->title }}</a></li>
                </ul>
            </div>
            @endif
        </div>

        <div class="row mt-4">
            <!-- Категории товаров -->
            <div class="col-md-6">
                <h3>Категории товаров</h3>
                <ul>
                    @foreach($categories->where('parent_id', null) as $cat)
                        <li>
                            <a href="{{ route('catalog', ['category' => $cat->category_id]) }}">{{ $cat->name }}</a>
                            @if($cat->categories->count())
                                <ul>
                                    @foreach($cat->categories as $sub)
                                        <li><a href="{{ route('catalog', ['category' => $sub->category_id]) }}">{{ $sub->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Товары (первые 20) -->
            <div class="col-md-6">
                <h3>Товары (примеры)</h3>
                <ul>
                    @foreach($products->take(20) as $product)
                        <li><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></li>
                    @endforeach
                    @if($products->count() > 20)
                        <li><em>... и ещё {{ $products->count() - 20 }} товаров</em></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Новости -->
            <div class="col-md-6">
                <h3>Новости</h3>
                <ul>
                    @foreach($news as $item)
                        <li><a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a> ({{ $item->published_at->format('d.m.Y') }})</li>
                    @endforeach
                </ul>
            </div>

            <!-- Акции (без ссылок, так как отдельных страниц нет) -->
            <div class="col-md-6">
                <h3>Акции</h3>
                <ul>
                    @foreach($promotions as $promo)
                        <li>{{ $promo->title }} ({{ $promo->start_date->format('d.m.Y') }} – {{ $promo->end_date->format('d.m.Y') }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>

@include('layouts.footer')