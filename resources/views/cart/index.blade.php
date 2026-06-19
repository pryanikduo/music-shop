@extends('layouts.app')

@section('title', __('messages.cart_title'))

@section('content')
<div class="cart-container">
    <h1>{{ __('messages.cart_title') }}</h1>
    <div id="cart-content" data-catalog-url="{{ route('catalog', ['locale' => app()->getLocale()]) }}">
        @include('cart.partials.cart_items', ['cart' => $cart, 'total' => $total])
    </div>
</div>
@endsection

<script src="{{ asset('js/cart.js') }}"></script>