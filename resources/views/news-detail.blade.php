@include('layouts.head')

@section('title', $news->title)

@include('layouts.menu')
<body>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="mb-3">{{ $news->title }}</h1>
                <div class="text-muted mb-4">
                    <ion-icon name="calendar-outline"></ion-icon> 
                    {{ \Carbon\Carbon::parse($news->published_at)->format('d.m.Y') }}
                </div>
                @if($news->image)
                    <img src="{{ asset($news->image) }}" class="img-fluid rounded mb-4" alt="{{ $news->title }}">
                @endif
                <div class="news-full-content" style="font-size: 1.1rem; line-height: 1.6;">
                    {!! $news->content !!}
                </div>
                <a href="{{ route('news', ['locale' => app()->getLocale()]) }}" class="btn mt-4" style="background-color: #fede67; color: #323232;">← {{ __('messages.back_to_news') }}</a>
            </div>
        </div>
    </div>

</body>
@include('layouts.footer')