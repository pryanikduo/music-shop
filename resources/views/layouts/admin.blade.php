<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Админ панель - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fc; }
        .sidebar { min-height: 100vh; background-color: #323232; color: #fff; }
        .sidebar a { color: #ddd; text-decoration: none; }
        .sidebar a:hover { color: #fede67; }
        .content { padding: 20px; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar p-0">
                <div class="position-sticky pt-3">
                    <h5 class="text-center py-3">Музыкальный магазин</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Дашборд</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}"><i class="fas fa-guitar"></i> Товары</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-folder"></i> Категории</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.promotions.index') }}"><i class="fas fa-tags"></i> Акции</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.news.index') }}"><i class="fas fa-newspaper"></i> Новости</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.pages.index') }}"><i class="fas fa-file-alt"></i> Страницы</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-cart"></i> Заказы</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings.edit') }}"><i class="fas fa-cog"></i> Настройки</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('main') }}"><i class="fas fa-home"></i> На сайт</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn nav-link" style="background:none; border:none; color:#ddd;"><i class="fas fa-sign-out-alt"></i> Выйти</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-10 ms-sm-auto px-md-4 content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>