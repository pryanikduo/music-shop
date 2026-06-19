document.addEventListener('DOMContentLoaded', function () {
    // Элементы, которые будут обновляться
    const cartContent = document.getElementById('cart-content');
    const cartTotalSpan = document.getElementById('cart-total');
    // Если у вас есть счётчик товаров в шапке, например, #cart-count, обновляйте его
    // const cartCountElement = document.getElementById('cart-count');

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
            // Показать сообщение пользователю (например, всплывающее уведомление)
            alert('Произошла ошибка. Попробуйте ещё раз.');
        });
    }

    // --- Обработчик изменения количества ---
    const quantityInputs = document.querySelectorAll('.cart-quantity-input');
    quantityInputs.forEach(input => {
        // Отправляем запрос при изменении значения (после потери фокуса или Enter)
        input.addEventListener('change', function () {
            const productId = this.dataset.productId;
            const updateUrl = this.dataset.updateUrl;
            const newQuantity = parseInt(this.value, 10);

            // Валидация
            const max = parseInt(this.max, 10);
            if (isNaN(newQuantity) || newQuantity < 1) {
                this.value = 1;
                return;
            }
            if (newQuantity > max) {
                this.value = max;
            }

            // Блокируем поле на время запроса (опционально)
            this.disabled = true;

            sendAjax(
                updateUrl,
                'PATCH', // или 'PATCH' – смотрите в вашем роуте
                { quantity: this.value },
                function (data) {
                    // Обновляем сумму конкретного товара
                    const itemTotalElement = document.getElementById('item-total-' + productId);
                    if (itemTotalElement) {
                        itemTotalElement.textContent = data.item_total + ' руб.';
                    }
                    // Обновляем общую сумму
                    if (cartTotalSpan) {
                        cartTotalSpan.textContent = data.total;
                    }
                    // Обновляем счётчик в шапке (если есть)
                    // if (cartCountElement) cartCountElement.textContent = data.cart_count;
                    // Снимаем блокировку поля
                    document.querySelector(`.cart-quantity-input[data-product-id="${productId}"]`).disabled = false;
                },
                function () {
                    // Восстанавливаем предыдущее значение при ошибке (можно перезагрузить страницу или вернуть старое)
                    // Например, вернуть значение из data.quantity, если оно было в ответе ошибки
                    document.querySelector(`.cart-quantity-input[data-product-id="${productId}"]`).disabled = false;
                }
            );
        });

        // Дополнительно: можно обрабатывать input с debounce, но change достаточно.
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

            // Блокируем кнопку (визуально)
            this.disabled = true;
            this.textContent = 'Удаление...';

            sendAjax(
                removeUrl,
                'DELETE', // или 'POST' – смотрите роуты
                {}, // тело пустое
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
                    // Обновляем счётчик в шапке
                    // if (cartCountElement) cartCountElement.textContent = data.cart_count;

                    // Если корзина пуста, подменяем содержимое на сообщение
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
                    // Восстанавливаем кнопку при ошибке
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