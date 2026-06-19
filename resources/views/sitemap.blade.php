@include('layouts.head')
@section('title', __('messages.sitemap_title'))
@include('layouts.menu')

<body>
    <div class="container mt-5">
        <h1>{{ __('messages.sitemap') }}</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>{{ __('messages.main_sections') }}</h3>
                <ul>
                    @foreach($staticPages as $page)
                        <li><a href="{{ $page['url'] }}">{{ $page['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            @php $aboutPage = $customPages->where('slug', 'about')->first(); @endphp
            @if($aboutPage)
            <div class="col-md-6">
                <h3>{{ __('messages.information') }}</h3>
                <ul>
                    <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ $aboutPage->title }}</a></li>
                </ul>
            </div>
            @endif
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h3>{{ __('messages.product_categories') }}</h3>
                <ul>
                    @foreach($categories->where('parent_id', null) as $cat)
                        <li>
                            <a href="{{ route('catalog', ['locale' => app()->getLocale(), 'category' => $cat->category_id]) }}">{{ $cat->name }}</a>
                            @if($cat->categories->count())
                                <ul>
                                    @foreach($cat->categories as $sub)
                                        <li><a href="{{ route('catalog', ['locale' => app()->getLocale(), 'category' => $sub->category_id]) }}">{{ $sub->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <h3>{{ __('messages.example_products') }}</h3>
                <ul>
                    @foreach($products->take(20) as $product)
                        <li><a href="{{ route('product.show', ['locale' => app()->getLocale(), 'slug' => $product->slug]) }}">{{ $product->name }}</a></li>
                    @endforeach
                    @if($products->count() > 20)
                        <li><em>{{ __('messages.and_more_products', ['count' => $products->count() - 20]) }}</em></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h3>{{ __('messages.news_section') }}</h3>
                <ul>
                    @foreach($news as $item)
                        <li><a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $item->slug]) }}">{{ $item->title }}</a> ({{ $item->published_at->format('d.m.Y') }})</li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <h3>{{ __('messages.promotions_section') }}</h3>
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