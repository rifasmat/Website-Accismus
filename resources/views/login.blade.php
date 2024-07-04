<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login Accismus Community</title>
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

</head>

<body>

  @if(session('success'))
  <div class="alert alert-success text-center">
    {{ session('success') }}
  </div>
  @endif

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="{{ asset('/') }}" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('assets/home/img/logo.png') }}" alt="">
                  <span class="d-none d-lg-block">Accismus Community</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login </h5>
                  </div>
                  <form class="row g-3 needs-validation" method="POST" action="{{ route('processLogin') }}" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="yourusernameemail" class="form-label">Username/Email</label>
                      <input type="text" name="usernameemail" class="form-control" id="yourusernameemail" placeholder="Enter Email/Username" required autocomplete="off">
                      <div class="invalid-feedback">Masukan Username/Email</div>
                      @error('usernameemail')
                      <div class="text-danger text-center">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Enter Password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                      @error('password')
                      <div class="text-danger text-center">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12 text-center">
                      <span>
                        <a href="{{ route('register') }}" class="small mb-0">Create an account</a>
                      </span>
                    </div>
                  </form>
                </div>
              </div>

              <div class="credits">
                <p>Accismus Community</p>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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

</body>

</html>