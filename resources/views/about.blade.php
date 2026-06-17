@include('layouts.head')

@section('title', $page->title ?? __('messages.about_title'))

@include('layouts.menu')
<body>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Блок истории компании -->
    <div class="container mt-5">
        {!! $page->content !!}
    </div>

    <!-- Статистика -->
    <section class="statistics">
        <div class="container py-4 pb-5">
            <h1>{{ __('messages.about_in_numbers') }}</h1>
            <div class="row">
                <div class="col-6 col-lg-2 m-0 m-auto my-2">
                    <div class="stat_style text-center py-4">
                        <h1>> 30 тыс.</h1>
                        <h3>{{ __('messages.happy_customers') }}</h3>
                    </div>
                </div>
                <div class="col-6 col-lg-2 m-0 m-auto my-2">
                    <div class="stat_style text-center py-4">
                        <h1>> 10 тыс.</h1>
                        <h3>{{ __('messages.positive_reviews') }}</h3>
                    </div>
                </div>
                <div class="col-6 col-lg-2 m-0 m-auto my-2">
                    <div class="stat_style text-center py-4">
                        <h1>> 10 тыс.</h1>
                        <h3>{{ __('messages.partners') }}</h3>
                    </div>
                </div>
                <div class="col-6 col-lg-2 m-0 m-auto my-2">
                    <div class="stat_style text-center py-4">
                        <h1>> 5 тыс.</h1>
                        <h3>{{ __('messages.stores') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Контакты, карта, формы -->
    <div class="container mb-5">
        <div class="row">
            <!-- Левая колонка -->
            <div class="col-md-6">
                <div class="contact-info p-4" style="background: #f8f8f5; border-radius: 20px;">
                    <h2 style="color: #323232; border-left: 4px solid #fede67; padding-left: 15px;">{{ __('messages.contacts') }}</h2>
                    <p><strong>{{ __('messages.phone_label') }}:</strong> {{ $phone ?? '+7 (978) 123 45 67' }}</p>
                    <p><strong>{{ __('messages.email_label') }}:</strong> {{ $email ?? 'nota@mail.ru' }}</p>
                    <p><strong>{{ __('messages.address_label') }}:</strong> {{ $address ?? 'г. Москва, ул. Арбат, д. 10' }}</p>

                    <div class="map mt-3">
                        <h3 style="font-size: 1.3rem;">{{ __('messages.map') }}</h3>
                        @if($map)
                            {!! $map !!}
                        @else
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2245.123456789!2d37.5903!3d55.7512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTXCsDQ1JzA0LjMiTiAzN8KwMzUnMjUuMiJF!5e0!3m2!1sru!2sru!4v1234567890123" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Правая колонка -->
            <div class="col-md-6">
                <!-- Обратная связь -->
                <div class="feedback-form p-4 mb-4" style="background: #f8f8f5; border-radius: 20px;">
                    <h2 style="color: #323232; border-left: 4px solid #fede67; padding-left: 15px;">{{ __('messages.feedback') }}</h2>
                    <form action="{{ route('contact.store', ['locale' => app()->getLocale()]) }}" method="POST" id="contactForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.your_name') }}</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.your_email') }}</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ __('messages.your_phone') }}</label>
                            <input type="tel" class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">{{ __('messages.your_message') }}</label>
                            <textarea class="form-control" name="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn" style="background-color: #fede67; color: #323232;">{{ __('messages.send') }}</button>
                    </form>
                </div>

                <!-- Техподдержка -->
                <div class="support-form p-4" style="background: #f8f8f5; border-radius: 20px;">
                    <h2 style="color: #323232; border-left: 4px solid #fede67; padding-left: 15px;">{{ __('messages.technical_support') }}</h2>
                    <form action="{{ route('support.store', ['locale' => app()->getLocale()]) }}" method="POST" id="supportForm">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label">{{ __('messages.subject') }}</label>
                            <input type="text" class="form-control" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="support_email" class="form-label">{{ __('messages.your_email') }}</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="support_message" class="form-label">{{ __('messages.your_message') }}</label>
                            <textarea class="form-control" name="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn" style="background-color: #fede67; color: #323232;">{{ __('messages.send_request') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('contactForm')?.addEventListener('submit', function(e) {
            let name = this.querySelector('[name="name"]').value.trim();
            let email = this.querySelector('[name="email"]').value.trim();
            let message = this.querySelector('[name="message"]').value.trim();
            if (!name || !email || !message) {
                e.preventDefault();
                alert('{{ __('messages.fill_contact_fields') }}');
            }
        });
        document.getElementById('supportForm')?.addEventListener('submit', function(e) {
            let subject = this.querySelector('[name="subject"]').value.trim();
            let email = this.querySelector('[name="email"]').value.trim();
            let message = this.querySelector('[name="message"]').value.trim();
            if (!subject || !email || !message) {
                e.preventDefault();
                alert('{{ __('messages.fill_support_fields') }}');
            }
        });
    </script>

</body>
@include('layouts.footer')