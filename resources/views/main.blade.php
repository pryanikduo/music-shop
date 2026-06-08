@include('layouts.head')

@section('title', 'Главная страница')

@include('layouts.menu')
<body>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Start Home -->
  <section class="home" id="home">
    <div class="container pt-5 pt-lg-0">
      <div class="row">
        <div class="col-12 col-lg-5 m-0 m-auto pt-5 ms-lg-5">
          <h2><i>2026</i></h2>
          <h1 class="mx-2">Горячие предложения</h1>
          <h4 class="mt-4 mb-2">Скидки до 20%</h4>
          <a href="#" type="button" class="my-1 mt-5">Открыть</a>
        </div>
        <div class="col-12 col-lg-6 m-0 m-auto pt-5">
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
              <li data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"></li>
              <li data-bs-target="#carouselExampleControls" data-bs-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/products/Home_2.png" class="d-block w-100" alt="Slide 1">
              </div>
              <div class="carousel-item">
                <img src="images/products/Home_1.png" class="d-block w-100" alt="Slide 2">
              </div>
            </div>
            <button class="carousel-control-next carousel_buttons" type="button"
              data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <ion-icon name="arrow-forward-circle-outline"></ion-icon>
            </button>
            <button class="carousel-control-prev carousel_buttons2" type="button"
              data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <ion-icon name="arrow-back-circle-outline"></ion-icon>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Home -->


  <!-- start brandss -->
  <section class="brands">
    <div class="container">

      <div class="row py-3">
        <div class="col-2 col-md-1 d-block m-0 m-auto"><img src="images/brands/gucci.png" alt="" width="100%">
        </div>
        <div class="col-2 col-md-1 d-block m-0 m-auto"><img src="images/brands/H&M.png" alt="" width="100%">
        </div>
        <div class="col-2 col-md-1 d-block m-0 m-auto"><img src="images/brands/nike.png" alt="" width="100%">
        </div>
        <div class="col-2 col-md-1 d-block m-0 m-auto"><img src="images/brands/the.png" alt="" width="100%">
        </div>
        <div class="col-2 col-md-1 d-block m-0 m-auto"><img src="images/brands/prada.png" alt="" width="100%">
        </div>
        <div class="col-2 col-md-1 d-block m-0 m-auto"><img src="images/brands/ellesse.png" alt=""
            width="100%"></div>
      </div>

    </div>
  </section>
  <!-- end brandss -->

  <!-- start new collection -->
  <section class="collection" id="collection">
    <div class="container py-5">
      <div class="row">

        <h1 class="mt-5">
          Новые Товары
        </h1>

        <div class="col-10 col-lg-3 m-0 m-auto sho_card my-5">
          <div class="card">
            <div class="card-text">
              <h2 class="card-title mt-3 ms-3">Электрогитары</h2>
              <div class="btn_sty">
                <a href="#" type="button">Открыть</a>
              </div>
            </div>
            <img src="images/products/N_C_3.png" alt="" class="card-image">
          </div>
        </div>
        <div class="col-10 col-lg-3 m-0 m-auto sho_card my-5 BG-GRAY">
          <div class="card BG-GRAY">
            <div class="card-text">
              <h2 class="card-title mt-3 ms-3">Барабанные установки</h2>
              <div class="btn_sty">
                <a href="#" type="button">Открыть</a>
              </div>
            </div>
            <img src="images/products/N_C_2.png" alt="" class="card-image">
          </div>
        </div>
        <div class="col-10 col-lg-3 m-0 m-auto sho_card my-5">
          <div class="card">
            <div class="card-text">
              <h2 class="card-title mt-3 ms-3">Синтезаторы</h2>
              <div class="btn_sty">
                <a href="#" type="button">Открыть</a>
              </div>
            </div>
            <img src="images/products/N_C_1.png" alt="" class="card-image">
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- end new collection -->


  <!-- start best sellers -->
  <section class="sellers" id="sellers">
    <div class="container py-5">
      <div class="row">

        <h1 class="mt-5">
          Топ Продаж
        </h1>

        <div class="col-6 col-lg-3 my-5 m-0 m-auto">
          <div class="card">
            <div class="btn_sty">
              <span href="#" class="me-3 hart_col">
                <ion-icon name="heart-outline" class="heart-outline"></ion-icon>
                <ion-icon name="heart" class="heart-filled"></ion-icon>
              </span>
            </div>
            <div class="img_conta">
              <img class="card-img-top" src="images/products/Sellers_1.png" alt="Card image cap">
            </div>
            <div class="card-body d-flex justify-content-between">
              <div>
                <h5 class="card-title">Электрогитара</h5>
                <p class="card-text">10000 р.</p>
              </div>
              <div class="mt-2 bag_col">
                <ion-icon name="bag-add-outline" class="py-1 px-2 me-2 bag-outline"></ion-icon>
                <ion-icon name="bag-check-outline" class="py-1 px-2 me-2 bag-filled"></ion-icon>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 my-5 m-0 m-auto">
          <div class="card">
            <div class="btn_sty">
              <span href="#" class="me-3 hart_col">
                <ion-icon name="heart-outline" class="heart-outline"></ion-icon>
                <ion-icon name="heart" class="heart-filled"></ion-icon>
              </span>
            </div>
            <div class="img_conta">
              <img class="card-img-top" src="images/products/Sellers_2.png" alt="Card image cap">
            </div>
            <div class="card-body d-flex justify-content-between">
              <div>
                <h5 class="card-title">Кларнет</h5>
                <p class="card-text">7500 р.</p>
              </div>
              <div class="mt-2 bag_col">
                <ion-icon name="bag-add-outline" class="py-1 px-2 me-2 bag-outline"></ion-icon>
                <ion-icon name="bag-check-outline" class="py-1 px-2 me-2 bag-filled"></ion-icon>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 my-5 m-0 m-auto">
          <div class="card">
            <div class="btn_sty">
              <span href="#" class="me-3 hart_col">
                <ion-icon name="heart-outline" class="heart-outline"></ion-icon>
                <ion-icon name="heart" class="heart-filled"></ion-icon>
              </span>
            </div>
            <div class="img_conta">
              <img class="card-img-top" src="images/products/Sellers_3.png" alt="Card image cap">
            </div>
            <div class="card-body d-flex justify-content-between">
              <div>
                <h5 class="card-title">Губная Гармошка</h5>
                <p class="card-text">5000 р.</p>
              </div>
              <div class="mt-2 bag_col">
                <ion-icon name="bag-add-outline" class="py-1 px-2 me-2 bag-outline"></ion-icon>
                <ion-icon name="bag-check-outline" class="py-1 px-2 me-2 bag-filled"></ion-icon>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 my-5 m-0 m-auto">
          <div class="card">
            <div class="btn_sty">
              <span href="#" class="me-3 hart_col">
                <ion-icon name="heart-outline" class="heart-outline"></ion-icon>
                <ion-icon name="heart" class="heart-filled"></ion-icon>
              </span>
            </div>
            <div class="img_conta">
              <img class="card-img-top" src="images/products/Sellers_4.png" alt="Card image cap">
            </div>
            <div class="card-body d-flex justify-content-between">
              <div>
                <h5 class="card-title">Синтезатор</h5>
                <p class="card-text">15000 р.</p>
              </div>
              <div class="mt-2 bag_col">
                <ion-icon name="bag-add-outline" class="py-1 px-2 me-2 bag-outline"></ion-icon>
                <ion-icon name="bag-check-outline" class="py-1 px-2 me-2 bag-filled"></ion-icon>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- end best sellers -->

</body>
@include('layouts.footer')