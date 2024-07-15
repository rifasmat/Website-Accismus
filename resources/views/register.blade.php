<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Register Accismus Community</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/home/img/favicon.ico') }}" rel="icon">
  <link href="{{ asset('assets/home/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">

  <style>
    #previewFoto {
      max-width: 150px;
      display: none;
    }
  </style>
</head>

<body>

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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  </div>
                  <form action="{{ route('processRegister') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control" id="nama" autocomplete="off" placeholder="Enter Name" required>
                      @error('nama')
                      <p style="color: red;">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="col-12 mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="username" autocomplete="off" placeholder="Enter Username" required>
                      @error('username')
                      <p style="color: red;">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="col-12 mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" autocomplete="off" placeholder="Enter Email" required>
                      @error('email')
                      <p style="color: red;">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="col-12 mb-3">
                      <label for="whatsapp" class="form-label">Whatsapp (Optional)</label>
                      <input type="number" name="wa" class="form-control" autocomplete="off" id="whatsapp">
                    </div>

                    <div class="col-12 mb-3">
                      <label for="discord" class="form-label">Nama Discord</label>
                      <input type="text" name="discord" class="form-control" autocomplete="off" placeholder="Enter Discord Name" id="discord">
                      @error('discord')
                      <p style="color: red;">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="col-12 mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" autocomplete="off" required>
                      @error('password')
                      <p style="color: red;">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="col-12 mb-3">
                      <label for="foto">Upload Photo</label>
                      <input type="file" class="form-control" name="foto" id="uploadFoto" onchange="previewImage()">
                      <img alt="Preview Foto" id="previewFoto">
                      @error('foto')
                      <p style="color: red;">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="col-12 mb-3">
                      <input type="hidden" name="role" class="form-control" id="role" value="Guest" required>
                    </div>

                    <div class="col-12 mb-3">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>

                    <div class="col-12 text-center">
                      <span>
                        <a href="{{ route('login') }}" class="small mb-0">Login</a>
                        <span>|</span>
                        <a href="{{ route('password.request') }}" class="small mb-0">Forgot Password</a>
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
  </main>

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
  <script src="{{ asset('assets/backend/js/main.js') }}"></script>
  <script>
    function previewImage() {
      const file = document.getElementById('uploadFoto').files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('previewFoto').style.display = 'block';
          document.getElementById('previewFoto').src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }
  </script>

</body>

</html>