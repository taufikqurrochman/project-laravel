@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Category</h1>
    </div>

    {{-- alert jika berhasil register didapat dari dashboardpostcontroller.php --}}
    @if (session()->has('success'))
      <div class="alert alert-primary col-lg-8" role="alert">
        {{-- pesan didapat dari session di dashboardpostcontroller --}}
        {{ session('success') }}
      </div>
    @endif
    {{-- end of alert --}}

    {{-- tampilkan data post dalam bentuk table --}}
    <div class="table-responsive col-lg-8">
      {{-- tombol untuk menambah postingan --}}
      <a href="/dashboard/posts/create" class="btn btn-primary">Create new category</a>
      {{-- end tombol --}}
        <table class="table table-striped table-sm mt-3">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            {{-- $posts didapat dari DashboardPostController functio index --}}
            @foreach ($categories as $category )
                <tr>
                    {{-- fungsi laravel untuk penomoran otomatis --}}
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        {{-- id diganti dengan slug cek diroute web --}}
                        <a href="/dashboard/categories/{{ $category->slug }}" class="badge bg-info">
                            <span data-feather="eye" class="align-text-bottom"></span>
                        </a>
                        {{-- untuk yang edit diending href tambahkan /edit, ini aturan default dari route resource, cara cek diterminal ketik php artisan route:list cari yang @edit--}}
                        <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning">
                            <span data-feather="edit" class="align-text-bottom"></span>
                        </a>

                        {{-- delete harus pakai form --}}
                        {{-- dikarenakan form ada block harus dirubah jadi inline --}}
                        <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                          @csrf
                          {{-- diarah methode didashboard post ke destroy --}}
                          @method('delete')

                          {{-- tambahkan javascript pop up are u sure ? --}}
                          <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')">
                            <span data-feather="trash-2" class="align-text-bottom"></span>
                          </button>
                        </form>

                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    {{-- end post table --}}
@endsection