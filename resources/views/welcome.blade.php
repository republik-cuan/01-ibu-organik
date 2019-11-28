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
            <a class="nav-link js-scroll-trigger" href="#galery">
             Galeri Produk
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">
              Kontak
            </a>
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
            <h2 class="mb-3">
              Halo, <strong>@ibuorganik</strong> adalah supplier sayur organik, buah organik, beras organik tersertifikasi, dan Bahan Pangan Organik Pilihan yang mengutamakan kualitas, karena kepuasan, kenyamanan dan kepercayaan  pelanggan yang utama bagi kami
            </h2>
            <a href="https://api.whatsapp.com/send?phone=628125881610&text=Halo%20@ibuorganik%20saya%20mau%20order%20sayur%20organik" class="btn btn-outline btn-xl js-scroll-trigger">Hubungi Kami</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class="download bg-primary text-center" id="download">
    <div class="container">
      <div class="row">
        <div class="col-md-10 mx-auto">
          <h2 class="section-heading">Tentang Kami</h2>
          <p class="text-justify">
            Berawal dari melakukan #PerjalnanHidupSehat @Ibuorganik memberikan solusi bagi masyarakat yang kesulitan
            mendapatkan produk sayuran, buah, beras dan bahan organik yang terpercaya, tersertifikasi.  Semua produk dari kami terseleksi, kami membangun tim dari hulu ke hilir untuk menjaga kwalitas.  Ibuorganik fokus menyebarkan manfaat yaitu memberikan informasi tentang #PerjalananHidupSehat dan informasi tentang makanan sehat yang mudah di dapat kepada masyarakat dan mengajak petani menanam dengan ramah lingkungan sehingga tidak merusak ekosistem yang ada di lahan tersebut.
          </p>
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
        <div class="col-lg-4 my-auto text-center">
          <img src="{{ asset('img/logo.png') }}" class="w-75" alt=""/>
        </div>
        <div class="col-lg-8 my-auto">
          <div class="container-fluid">
            <div class="row">
            	@foreach ($about as $item)
								<div class="col-6">
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

  <section class="cta p-5" id="galery">
    <div class="cta-content">
      <div class="container">
        <center>
          <h2>Galeri Produk</h2>
          <div class="row align-items-center">
            @foreach (range(1,34) as $item)
              <div class="col-md-4 py-3">
                <div class="card w-75">
                  <img class="card-img-top" src="{{ asset('img/warna_'.sprintf("%02d", $item).'.jpg') }}">
                </div>
              </div>
            @endforeach
          </div>
        </center>
      </div>
    </div>
    <div class="overlay"></div>
  </section>

  <section class="contact bg-primary" id="contact">
    <div class="container">
      <h2>Talk with us at</h2>
      <ul class="list-inline list-social">
        <li class="list-inline-item social-whatsapp">
          <a href="https://api.whatsapp.com/send?phone=628125881610&text=Halo%20@ibuorganik%20saya%20mau%20order%20sayur%20organik" target="_blank">
            <i class="fab fa-whatsapp"></i>
          </a>
        </li>
        <li class="list-inline-item social-twitter">
          <a href="https://www.instagram.com/ibuorganik/" target="_blank">
            <i class="fab fa-instagram"></i>
          </a>
        </li>
        <li class="list-inline-item social-google-plus">
          <a href="mailto:ibuorganik@gmail.com" target="_blank">
            <i class="fas fa-envelope"></i>
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
