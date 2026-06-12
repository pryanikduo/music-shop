@extends('layouts.admin')

@section('title', 'Панель управления')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Панель управления</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Товары</h5>
                    <p class="card-text">Управление каталогом</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Заказы</h5>
                    <p class="card-text">Просмотр и обработка</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light">Перейти</a>
                </div>
            </div>
        </div>
        <!-- аналогично другие карточки -->
    </div>
</div>
@endsection