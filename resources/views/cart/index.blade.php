@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="cart-container" style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
    <h1>Корзина</h1>
    <div id="cart-content">
        @include('cart.partials.cart_items', ['cart' => $cart, 'total' => $total])
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateCartItem(productId, quantity) {
        fetch('/cart/update/' + productId, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Обновить сумму позиции
                const itemTotalSpan = document.getElementById(`item-total-${data.product_id}`);
                if (itemTotalSpan) itemTotalSpan.innerText = data.item_total + ' руб.';
                // Обновить общую сумму
                const totalSpan = document.getElementById('cart-total');
                if (totalSpan) totalSpan.innerText = data.total + ' руб.';
                // Обновить счётчик в шапке
                const cartCountElem = document.querySelector('.cart-count');
                if (cartCountElem) {
                    cartCountElem.innerText = data.cart_count;
                    if (data.cart_count == 0) cartCountElem.style.display = 'none';
                    else cartCountElem.style.display = '';
                }
                // Если товар удалён (количество = 0), убрать строку
                if (data.quantity === 0) {
                    const row = document.getElementById(`cart-item-${data.product_id}`);
                    if (row) row.remove();
                }
                // Если корзина пуста, показать сообщение
                if (data.cart_count === 0) {
                    document.getElementById('cart-content').innerHTML = '<p>Ваша корзина пуста. <a href="{{ route("catalog") }}">Перейти в каталог</a></p>';
                }
            } else {
                alert('Ошибка: ' + (data.error || 'Не удалось обновить'));
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function removeCartItem(productId) {
        if (!confirm('Удалить все товары этого типа из корзины?')) return;
        fetch('/cart/remove/' + productId, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Удалить строку товара
                const row = document.getElementById(`cart-item-${data.product_id}`);
                if (row) row.remove();
                // Обновить общую сумму
                const totalSpan = document.getElementById('cart-total');
                if (totalSpan) totalSpan.innerText = data.total + ' руб.';
                // Обновить счётчик
                const cartCountElem = document.querySelector('.cart-count');
                if (cartCountElem) {
                    cartCountElem.innerText = data.cart_count;
                    if (data.cart_count == 0) cartCountElem.style.display = 'none';
                    else cartCountElem.style.display = '';
                }
                // Если корзина пуста
                if (data.cart_empty) {
                    document.getElementById('cart-content').innerHTML = '<p>Ваша корзина пуста. <a href="{{ route("catalog") }}">Перейти в каталог</a></p>';
                }
            } else {
                alert('Ошибка удаления');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Автоматическое обновление при изменении количества
        document.body.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('cart-quantity-input')) {
                let productId = e.target.getAttribute('data-product-id');
                let quantity = parseInt(e.target.value, 10);
                if (isNaN(quantity)) quantity = 1;
                let max = parseInt(e.target.getAttribute('max'), 10);
                if (quantity < 1) quantity = 1;
                if (quantity > max) quantity = max;
                e.target.value = quantity;
                updateCartItem(productId, quantity);
            }
        });

        // Обработчик удаления
        document.body.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-all-btn')) {
                e.preventDefault();
                let productId = e.target.getAttribute('data-product-id');
                if (productId) removeCartItem(productId);
            }
        });
    });
</script>
@endpush