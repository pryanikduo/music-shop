@extends('layouts.admin')

@section('title', 'Панель управления')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Панель управления</h1>
    <div class="row">
        <!-- Товары -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Товары</h5>
                    <p class="card-text">Управление каталогом</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- Категории -->
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Категории</h5>
                    <p class="card-text">Управление категориями</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- Акции -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Акции</h5>
                    <p class="card-text">Управление акциями и скидками</p>
                    <a href="{{ route('admin.promotions.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- Новости -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Новости</h5>
                    <p class="card-text">Управление новостями</p>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- Страницы -->
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Страницы</h5>
                    <p class="card-text">Управление статическими страницами</p>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- Заказы -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Заказы</h5>
                    <p class="card-text">Просмотр и обработка</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- Сообщения обратной связи -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Сообщения</h5>
                    <p class="card-text">Обратная связь от пользователей</p>
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- Тикеты поддержки -->
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Тикеты</h5>
                    <p class="card-text">Запросы в техподдержку</p>
                    <a href="{{ route('admin.support-tickets.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- Настройки -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Настройки</h5>
                    <p class="card-text">Контакты, соцсети, карта</p>
                    <a href="{{ route('admin.settings.edit') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- Пользователи -->
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Пользователи</h5>
                    <p class="card-text">Управление учётными записями и правами</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection