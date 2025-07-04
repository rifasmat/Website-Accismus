<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Accismus Community</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/home/img/favicon.ico') }}" rel="icon">
  <link href="{{ asset('assets/home/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/css/custom.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('senate.dashboard.list') }}" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block ">Accismus Community</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <!-- Home Icon -->
        <a class="nav-link nav-icon" href="{{ route('senate.home') }}">
          <i class="bi bi-house-door"></i>
        </a>
        <!-- End Home Icon -->

        <!-- Profil user -->
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown">
            <img src="{{ Storage::url(Auth::user()->foto) }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nama }}</span>
          </a><!-- End Profile Iamge Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header d-flex align-items-center">
              <img src="{{ Storage::url(Auth::user()->foto) }}" alt="Profile" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
              <div>
                <h6>{{ Auth::user()->nama }}</h6>
                <span>{{ Auth::user()->role }}</span>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('senate.profil.list') }}">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <!-- Hidden logout form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>

            <!-- Logout link -->
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  @include('senate.layouts.sidebar')

  <main id="main" class="main">

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Accismus Community</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/backend/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/backend/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/backend/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/backend/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/backend/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/backend/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/backend/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/backend/js/main.js') }}"></script>
  <script src="{{ asset('assets/backend/js/sweet-alert.js') }}"></script>

  <!-- Custom Javascript -->
  <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Tools Text Area -->
  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

  <!-- Menampilan tools text -->
  <script>
    CKEDITOR.replace('text');
  </script>

</body>

</html>