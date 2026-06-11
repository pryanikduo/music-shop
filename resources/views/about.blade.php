@include('layouts.head')

@section('title', $page->title ?? 'О нас')

@include('layouts.menu')
<body>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Блок истории компании (динамический) -->
    <div class="container mt-5">
        {!! $page->content !!}
    </div>

    <!-- Блок статистики -->
    <section class="statistics">
        <div class="container py-4 pb-5">
            <h1>О нас в цифрах</h1>
            <div class="row">
                <div class="col-6 col-lg-2 m-0 m-auto my-2">
                    <div class="stat_style text-center py-4">
                        <h1>> 30 тыс.</h1>
                        <h3>Довольных покупателей</h3>
                    </div>
                </div>
                <div class="col-6 col-lg-2 m-0 m-auto my-2">
                    <div class="stat_style text-center py-4">
                        <h1>> 10 тыс.</h1>
                        <h3>Положительных отзывов</h3>
                    </div>
                </div>
                <div class="col-6 col-lg-2 m-0 m-auto my-2">
                    <div class="stat_style text-center py-4">
                        <h1>> 10 тыс.</h1>
                        <h3>Партнёров</h3>
                    </div>
                </div>
                <div class="col-6 col-lg-2 m-0 m-auto my-2">
                    <div class="stat_style text-center py-4">
                        <h1>> 5 тыс.</h1>
                        <h3>Магазинов по России</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Блок контактов, карты, обратной связи и техподдержки -->
    <div class="container mb-5">
        <div class="row">
            <!-- Левая колонка: Контакты и карта -->
            <div class="col-md-6">
                <div class="contact-info p-4" style="background: #f8f8f5; border-radius: 20px;">
                    <h2 style="color: #323232; border-left: 4px solid #fede67; padding-left: 15px;">Контакты</h2>
                    <p><strong>Телефон:</strong> {{ $phone ?? '+7 (978) 123 45 67' }}</p>
                    <p><strong>Email:</strong> {{ $email ?? 'nota@mail.ru' }}</p>
                    <p><strong>Адрес:</strong> {{ $address ?? 'г. Москва, ул. Арбат, д. 10' }}</p>

                    <div class="map mt-3">
                        <h3 style="font-size: 1.3rem;">Схема проезда</h3>
                        @if($map)
                            {!! $map !!}
                        @else
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2245.123456789!2d37.5903!3d55.7512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTXCsDQ1JzA0LjMiTiAzN8KwMzUnMjUuMiJF!5e0!3m2!1sru!2sru!4v1234567890123" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Правая колонка: Обратная связь и Техподдержка -->
            <div class="col-md-6">
                <!-- Форма обратной связи -->
                <div class="feedback-form p-4 mb-4" style="background: #f8f8f5; border-radius: 20px;">
                    <h2 style="color: #323232; border-left: 4px solid #fede67; padding-left: 15px;">Обратная связь</h2>
                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Ваше имя *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="tel" class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Сообщение *</label>
                            <textarea class="form-control" name="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn" style="background-color: #fede67; color: #323232;">Отправить</button>
                    </form>
                </div>

                <!-- Форма техподдержки -->
                <div class="support-form p-4" style="background: #f8f8f5; border-radius: 20px;">
                    <h2 style="color: #323232; border-left: 4px solid #fede67; padding-left: 15px;">Техническая поддержка</h2>
                    <form action="{{ route('support.store') }}" method="POST" id="supportForm">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label">Тема *</label>
                            <input type="text" class="form-control" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="support_email" class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="support_message" class="form-label">Сообщение *</label>
                            <textarea class="form-control" name="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn" style="background-color: #fede67; color: #323232;">Отправить запрос</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Простая клиентская валидация (для удобства)
        document.getElementById('contactForm')?.addEventListener('submit', function(e) {
            let name = this.querySelector('[name="name"]').value.trim();
            let email = this.querySelector('[name="email"]').value.trim();
            let message = this.querySelector('[name="message"]').value.trim();
            if (!name || !email || !message) {
                e.preventDefault();
                alert('Пожалуйста, заполните обязательные поля (имя, email, сообщение).');
            }
        });
        document.getElementById('supportForm')?.addEventListener('submit', function(e) {
            let subject = this.querySelector('[name="subject"]').value.trim();
            let email = this.querySelector('[name="email"]').value.trim();
            let message = this.querySelector('[name="message"]').value.trim();
            if (!subject || !email || !message) {
                e.preventDefault();
                alert('Пожалуйста, заполните все поля.');
            }
        });
    </script>

</body>
@include('layouts.footer')