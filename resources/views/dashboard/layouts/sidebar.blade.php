<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">

      <ul class="nav flex-column">
        <li class="nav-item">
          {{-- agar link menyala atau class active jalan maka jalankan request saja, active jalan jika dihalaman dashboard index --}}
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          {{-- active jalan jika halaman dashboard > posts > index --}}
          {{-- tambahan wildcard * maka semua file yang ada difolder posts akan aktif --}}
          <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
            <span data-feather="file-text" class="align-text-bottom"></span>
            My Posts
          </a>
        </li>
      </ul>
      
      {{-- admin didapat dari appservice --}}
      @can('admin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-end px-3 mt-4 mb-1 text-mutedx">
          <span>Administrator</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            {{-- tambahan wildcard * maka semua file yang ada difolder posts akan aktif --}}
            <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
              <span data-feather="grid" class="align-text-bottom">
              </span>
              Post Categories
            </a>
          </li>
        </ul>        
      @endcan

    </div>
  </nav>