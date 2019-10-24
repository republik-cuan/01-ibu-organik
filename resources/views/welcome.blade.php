<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ibu Organik</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

  <link href="{{ asset('css/new-age.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Ibu Organik</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#download">Tentang Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#features">Kelebihan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Galeri Produk</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-lg-7 my-auto">
          <div class="header-content mx-auto">
            <h1 class="mb-5">
                Mengutamakan kualitas bukan kuantitas karna kepuasan pleanggan adalah yang utama
            </h1>
            <a href="#download" class="btn btn-outline btn-xl js-scroll-trigger">Tentang Kami</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class="download bg-primary text-center" id="download">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <h2 class="section-heading">Tentang Kami</h2>
          <p>Kami merupakan retail sayuran organik asal semarang, kualitas merupakan hargadiri kami sebagai penjual.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="features" id="features">
    <div class="container">
      <div class="section-heading text-center">
        <h2>Kelebihan</h2>
      </div>
      <div class="row">
        <div class="col-lg-4 my-auto">
          <img src="{{ asset('img/logo.png') }}" class="w-75" alt=""/>
        </div>
        <div class="col-lg-8 my-auto">
          <div class="container-fluid">
            <div class="row">
            	@foreach ($about as $item)
								<div class="col-lg-6">
									<div class="feature-item">
										<i class="{{ $item['icon'] }} fa-10x"></i>
										<h3>{{ $item['label'] }}</h3>
										<p class="text-muted">{{ $item['description'] }}</p>
									</div>
								</div>
							@endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta p-5">
    <div class="cta-content">
      <div class="container">
        <center>
          <h2>Galeri Produk</h2>
          <div class="row">
            @foreach ($items as $item)
              <div class="col-md-3 py-3">
                <div class="card">
                  <img class="card-img-top" src="{{ asset('img/01.jpg') }}">
                </div>
              </div>
            @endforeach
        </center>
        </div>
      </div>
    </div>
    <div class="overlay"></div>
  </section>

  <section class="contact bg-primary" id="contact">
    <div class="container">
      <h2>Talk with us at</h2>
      <ul class="list-inline list-social">
        <li class="list-inline-item social-twitter">
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li class="list-inline-item social-facebook">
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li class="list-inline-item social-google-plus">
          <a href="#">
            <i class="fab fa-google-plus-g"></i>
          </a>
        </li>
      </ul>
    </div>
  </section>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/new-age.min.js') }}"></script>

</body>

</html>