{{-- dump and die untuk melihat object dari array seperti var dump --}}
{{-- @dd($posts) --}}


{{-- memanggil layouts main.blade.php --}}
@extends('layouts.main')

{{-- untuk merubahan container yang ada dimain.blade.php --}}
@section('container')
    <div class="container">
        <div class="row">
            <h1>{{ $title }}</h1>
            {{-- looping agar semua data muncul --}}
            @foreach ($categories as $category)
            <div class="col-md-4 mb-3">
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/random/500x500/?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
                    <div class="card-img-overlay d-flex align-items-center p-0">
                      <h5 class="card-title text-center px-3 py-2 flex-fill" style="background-color: rgba(0, 0, 0, 0.7)">
                        {{-- akan menampilkan slug dari route --}}
                        {{-- sekarang yang dikirim slug bukan id lagi --}}
                        <a href="/posts?category={{ $category->slug }}" class="text-decoration-none text-white">{{  $category->name  }}</a>
                      </h5>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection