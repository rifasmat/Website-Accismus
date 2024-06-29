<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accismus Community</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error-image {
            max-width: 30%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <h1 class="display-4">Halaman Tidak Ditemukan</h1>
        <img src="{{ asset('storage/404/404.jpg') }}" alt="Error 404" class="error-image">
        <p class="lead">Halaman yang anda cari tidak ada</p>
        <button onclick="goBack()" class="btn btn-primary">Kembali</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>