@include('layouts.head')

@section('title', 'Главная страница')

@include('layouts.menu')
<body>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

      <!-- start news -->
  <section class="news">
    <div class="container py-5">
      <div class="row">

        <h1 class="mt-5">
          Последние новости
        </h1>

        <div class="col-10 col-lg-4 col-xl-3 my-5 m-0 m-auto">
          <div class="card">
            <div class="btn_sty">
              <ion-icon name="arrow-forward-outline"></ion-icon>
            </div>
            <div class="news_date">
              <h4>
                01 05 2026
              </h4>
            </div>
            <img class="card-img-top" src="img/guitars.jpg" alt="Card image cap">
            <div class="card-body">
              <h3 class="card-title">Новая коллекция гитар Marshall уже у нас!</h3>
              <p class="card-text my-3">Самые популярные представители мира гитар от бренда Marshall доступны 
                для покупки в нашей сети.</p>
            </div>
          </div>
        </div>
        <div class="col-10 col-lg-4 col-xl-3 my-5 m-0 m-auto">
          <div class="card">
            <div class="btn_sty">
              <ion-icon name="arrow-forward-outline"></ion-icon>
            </div>
            <div class="news_date">
              <h4>
                11 05 2026
              </h4>
            </div>
            <img class="card-img-top" src="img/yamaha_synthesizer.jpg" alt="Card image cap">
            <div class="card-body">
              <h3 class="card-title">Синтезатор Yamaha SY77 уже доступен для покупки!</h3>
              <p class="card-text my-3">Один из лучших в своём роде — синтезатор SY77 от бренда Yamaha уже готов
                стать твоим проводником в мир музыки.</p>
            </div>
          </div>
        </div>
        <div class="col-10 col-lg-4 col-xl-3 my-5 m-0 m-auto">
          <div class="card">
            <div class="btn_sty">
              <ion-icon name="arrow-forward-outline"></ion-icon>
            </div>
            <div class="news_date">
              <h4>
                01 06 2026
              </h4>
            </div>
            <img class="card-img-top" src="img/otkritie.jpg" alt="Card image cap">
            <div class="card-body">
              <h3 class="card-title">Новый магазин открыл свои двери для вас!</h3>
              <p class="card-text my-3">Новый магазин нашей сети открылся по адресу ул. Университетская 33
                и уже ждёт вас к себе в гости.
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- end news -->

  <!-- Start Jumbotron -->
  <div class="jumbotron pb-4" id="jumbotron">
    <div class="container pb-5">
      <div class="row">

        <h4 class="text-center">
          Оставайся с нами на связи и получи скидку в 15%<br>на свой первый заказ!</h4>
        </h4>

        <div class="col-12 col-lg-6 m-0 m-auto mt-4">
          <form action="#" class="text-center">
            <input type="email" placeholder="example@gmail.com" required>
            <button type="submit">
              Отправить
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- End Jumbotron -->

</body>
@include('layouts.footer')