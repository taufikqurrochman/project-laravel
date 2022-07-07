{{-- @extends('layouts.main')

@section('container')
    <h1>Halaman Dashboard</h1>
@endsection --}}

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taufik | Dashboard</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
   {{-- link arahkan ke file public > css > dashboard --}}
    <link href="/css/dashboard.css" rel="stylesheet">

    {{-- trix editor --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>
    {{-- end trix editor --}}

    {{-- untuk menghilangkan fungsi attachment ditrix editor --}}
    <style>
      trix-toolbar [data-trix-button-group="file-tools"]{
        display: none;
      }
    </style>
    {{-- end fungsi menghilangkan --}}
  </head>
  <body>
    
{{-- header --}}
    @include('dashboard.layouts.header')
{{-- end header --}}

<div class="container-fluid">
  <div class="row">

    {{-- navbar --}}
    @include('dashboard.layouts.sidebar')
    {{-- end of navbar --}}

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        {{-- agar setiap halaman berbeda maka tambahkan yield, stuktur disini pakai @include semua --}}
        @yield('container')

    </main>
  </div>
</div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

    {{-- script untuk grafik --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script> --}}

    {{-- arahkan filenya ke public > js --}}
    <script src="/js/dashboard.js"></script>
  </body>
</html>
