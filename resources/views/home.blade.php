<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Accismus Community</title>
  <meta content="Accismus community merupakan komunitsa RF Online private server yang terbentuk pada januari 2024" name="description">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:image" content="{{ Storage::url('accismus/accismus.jpeg') }}">

  <!-- Google Fonts  -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files  -->
  <link href="{{ asset('assets/home/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/home/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File  -->
  <link href="{{ asset('assets/home/css/style.css') }}" rel="stylesheet">
  <!-- Custom Css -->
  <link href="{{ asset('assets/home/css/custom.css') }}" rel="stylesheet">

  <!-- GLightbox CSS  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
</head>

<body>

  <!-- Header  -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="{{ asset('/') }}">Accismus Community<span></span></a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#history">History RF</a></li>
          <li><a class="nav-link scrollto " href="#gallery">Gallery</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="{{ route('login') }}" class="get-started-btn scrollto">Login</a>

    </div>
  </header>
  <!-- End Header  -->

  <!-- ======= Informasi Section ======= -->
  <section id="informasi" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">
      @foreach($informasi as $info)
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-10 col-lg-8">
          <div>
            <h1>{{ $info->informasi_judul }}</h1>
            <div><span>
                <h2>{{ $info->informasi_subjudul }} - {{ $info->informasi_rf }}</h2>
              </span></div>
          </div>
        </div>
      </div>
      <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
        <div class="col-xl-2 col-md-4">
          <div class="icon-box" id="instagram-icon" data-url="{{ $info->informasi_instagram }}">
            <i class="ri-instagram-line"></i>
            <h3><a href="{{ $info->informasi_instagram }}" target="_blank">Instagram</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box" id="discord-icon" data-url="{{ $info->informasi_discord }}">
            <i class="ri-discord-line"></i>
            <h3><a href="{{ $info->informasi_discord }}" target="_blank">Discord</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box" id="whatsapp-icon" data-url="{{ $info->informasi_wa }}">
            <i class="ri-whatsapp-line"></i>
            <h3><a href="{{ $info->informasi_wa }}" target="_blank">Whatsapp</a></h3>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section><!-- End Informasi -->

  <main id="main">
    <!-- About Section -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>About</h2>
        </div>
        @foreach($about as $tentang)
        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="{{ Storage::url($tentang->about_foto) }}" class="img-fluid rounded-circle" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
            <h3>{{ $tentang->about_judul }}</h3>
            <p class="fst-italic">
              {!! nl2br(e($tentang->about_text)) !!}
            </p>
          </div>
        </div>
        @endforeach
      </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Benefit Section ======= -->
    <section id="benefit" class="benefit">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Accismus Community</h2>
        </div>
        <div class="row no-gutters">
          @foreach($benefits as $benefit)
          <div class="image col-xl-6 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right" data-aos-delay="100" style="background: url('{{ Storage::url($benefit->benefit_foto) }}') center center no-repeat; background-size: cover;"></div>
          <div class="col-xl-6 ps-4 ps-lg-5 pe-4 pe-lg-1 d-flex align-items-stretch" data-aos="fade-left" data-aos-delay="100">
            <div class="content d-flex flex-column justify-content-center">
              <h3>{{ $benefit->benefit_judul }}</h3>
              <p class="fst-italic">
                {!! nl2br(e($benefit->benefit_text)) !!}
              </p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section><!-- End Counts Section -->

    <!-- ======= History RF Section ======= -->
    <section id="history" class="history">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>History RF</h2>
          <p>HISTORY RF</p>
        </div>
        <div class="row">
          @foreach($history as $historyrf)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="{{ Storage::url($historyrf->history_foto) }}" class="img-fluid" style="width: 30%; height: 30%;">
              </div>
              <div class="member-info">
                <h4>{{ $historyrf->history_rf }}</h4>
                <span>{{ $historyrf->history_tahun }}</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section><!-- End History RF Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Team</h2>
          <p>ACCISMUS TEAM</p>
        </div>
        <div class="row">
          @foreach($users as $user)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="{{ Storage::url($user->foto) }}" class="img-fluid" style="width: 250px; height: 250px;">
              </div>
              <div class="member-info">
                <h4>{{ $user->username }}</h4>
                <span>{{ $user->role }}</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section><!-- End Team Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Gallery</h2>
          <p>Check our Gallery</p>
        </div>
        <div class="row gallery-container" data-aos="fade-up" data-aos-delay="200">
          @foreach($gallery as $photo)
          <div class="col-lg-4 col-md-6 gallery-item filter-card">
            <div class="gallery-wrap">
              <a href="{{ Storage::url($photo->gallery_foto) }}" class="glightbox">
                <img src="{{ Storage::url($photo->gallery_foto) }}" class="img-fluid" alt="{{ $photo->gallery_rf }}">
                <div class="gallery-info">
                  <h4>{{ $photo->gallery_judul }}</h4>
                  <p>{{ $photo->gallery_rf }}</p>
                </div>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- End Gallery Section -->
  </main>
  <!-- End #main  -->

  <!-- Footer  -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Accismus</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor Js File -->
  <script src="{{ asset('assets/home/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/home/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/home/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/home/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/home/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/home/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/home/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main Js File -->
  <script src="{{ asset('assets/home/js/main.js') }}"></script>

  <!-- Custom JS -->
  <script src="{{ asset('assets/home/js/custom.js') }}"></script>

  <!-- GLightbox JS  -->
  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>


</body>

</html>