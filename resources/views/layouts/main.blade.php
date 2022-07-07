<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    {{-- bootstrap icon --}}

    {{-- css style didapat difolder public > css > style.css --}}
    <link rel="stylesheet" href="/css/style.css">
    {{-- end style --}}

    <title>Taufik Blog | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>

{{-- untuk memanggil navbar.blade.php --}}
@include('partials.navbar')
{{-- end panggil navbar.blade.php --}}

<div class="container mt-4">
  {{-- agar section dihome,about dan posts terbaca harus pakai @yield--}}
  @yield('container')
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>