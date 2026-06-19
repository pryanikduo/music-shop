document.addEventListener('DOMContentLoaded', function () {
    const cartContent = document.getElementById('cart-content');
    const cartTotalSpan = document.getElementById('cart-total');
    const cartCountElement = document.getElementById('cart-count');

    // Инициализация: показываем счётчик, если есть товары
    if (cartCountElement) {
        const initialCount = parseInt(cartCountElement.textContent, 10);
        if (initialCount > 0) {
            cartCountElement.style.display = '';
        } else {
            cartCountElement.style.display = 'none';
        }
    } // теперь активен

    // Функция для отправки AJAX-запроса
    function sendAjax(url, method, data, onSuccess, onError) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (onSuccess) onSuccess(data);
        })
        .catch(error => {
            console.error('Ошибка:', error);
            if (onError) onError(error);
            alert('Произошла ошибка. Попробуйте ещё раз.');
        });
    }

    // Функция обновления счётчика в шапке
    function updateCartCount(count) {
        if (cartCountElement) {
            cartCountElement.textContent = count;
            if (count > 0) {
                cartCountElement.style.display = '';
            } else {
                cartCountElement.style.display = 'none';
            }
        }
    }

    // --- Обработчик изменения количества ---
    const quantityInputs = document.querySelectorAll('.cart-quantity-input');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function () {
            const productId = this.dataset.productId;
            const updateUrl = this.dataset.updateUrl;
            const newQuantity = parseInt(this.value, 10);

            const max = parseInt(this.max, 10);
            if (isNaN(newQuantity) || newQuantity < 1) {
                this.value = 1;
                return;
            }
            if (newQuantity > max) {
                this.value = max;
            }

            this.disabled = true;

            sendAjax(
                updateUrl,
                'PATCH',
                { quantity: this.value },
                function (data) {
                    // Обновляем сумму конкретного товара
                    const itemTotalElement = document.getElementById('item-total-' + productId);
                    if (itemTotalElement) {
                        itemTotalElement.textContent = data.item_total + ' руб.';
                    }
                    // Обновляем общую сумму корзины
                    if (cartTotalSpan) {
                        cartTotalSpan.textContent = data.total;
                    }
                    // Обновляем счётчик в шапке
                    updateCartCount(data.cart_count);
                    // Разблокируем поле
                    document.querySelector(`.cart-quantity-input[data-product-id="${productId}"]`).disabled = false;
                },
                function () {
                    document.querySelector(`.cart-quantity-input[data-product-id="${productId}"]`).disabled = false;
                }
            );
        });
    });

    // --- Обработчик удаления товара ---
    const removeButtons = document.querySelectorAll('.remove-all-btn');
    removeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.productId;
            const removeUrl = this.dataset.removeUrl;

            if (!confirm('Удалить этот товар из корзины?')) {
                return;
            }

            this.disabled = true;
            this.textContent = 'Удаление...';

            sendAjax(
                removeUrl,
                'DELETE',
                {},
                function (data) {
                    // Удаляем элемент товара из DOM
                    const cartItem = document.getElementById('cart-item-' + productId);
                    if (cartItem) {
                        cartItem.remove();
                    }

                    // Обновляем общую сумму
                    if (cartTotalSpan) {
                        cartTotalSpan.textContent = data.total;
                    }
                    // Обновляем счётчик
                    updateCartCount(data.cart_count);

                    // Если корзина пуста, показываем сообщение
                    if (data.cart_empty) {
                        const catalogUrl = document.getElementById('cart-content').dataset.catalogUrl;
                        const emptyHtml = `
                            <div class="cart-empty-message">
                                <p>Ваша корзина пуста. <a href="${catalogUrl}" class="gold-link">Перейти в каталог</a></p>
                            </div>
                        `;
                        if (cartContent) {
                            cartContent.innerHTML = emptyHtml;
                        }
                    }
                },
                function () {
                    const btn = document.querySelector(`.remove-all-btn[data-product-id="${productId}"]`);
                    if (btn) {
                        btn.disabled = false;
                        btn.textContent = '✕ Удалить';
                    }
                }
            );
        });
    });
});