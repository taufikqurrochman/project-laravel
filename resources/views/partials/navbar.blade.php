{{-- navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient">
    <div class="container">
      <a class="navbar-brand" href="/">Taufik Blog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ ($active == "home") ? 'active' : ''}}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active == "about") ? 'active' : '' }}" href="/about">About</a>
          </li>
          <li class="nav-item">
              {{-- sesuaikan dengan route /blog, tetapi memangil view posts.blade --}}
            <a class="nav-link {{ ($active == "posts") ? 'active' : '' }}" href="/posts">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active == "categories") ? 'active' : '' }}" href="/categories">Categories</a>
          </li>
        </ul>

        {{-- agar yang sudah login tombol login hilang --}}
        {{-- jika sudah login akan masuk ke @auth --}}
        <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{-- fungsi untuk memanggil user yang login ke table user dan memanggil nama --}}
              Welcome back,  {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window-reverse"></i> My Dashboard</a>
              </li>

              <li><hr class="dropdown-divider"></li>

              <li>

                {{-- untuk logout tidak pakai halaman hanya pakai form saja --}}

                <form action="/logout" method="post">

                  @csrf
                  <button type="submit" class="dropdown-item">
                    <i class="bi bi-box-arrow-right"></i> Logout
                  </button>
                </form>
                {{-- end form logout --}}

              </li>
            </ul>
          </li>
        {{-- jika belum login akan masuk ke @else --}}
        @else
          <li class="nav-item">
            <a class="nav-link {{ ($active == "login") ? 'active' : '' }}" href="/login" class="nav-link"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
        </ul>
        @endauth

      </div>
    </div>
  </nav>
  {{-- end of navbar --}}
