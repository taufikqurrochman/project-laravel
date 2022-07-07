@extends('layouts.main')

@section('container')

{{-- halaman login --}}

{{-- biasakan dibootstrap untuk buat row dan col sesuaikan ukurannya --}}
<div class="row justify-content-center">
  <div class="col-lg-5">
    <main class="form-registration w-100 m-auto">
      <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
      {{-- form ini lempar ke route web yang method post --}}
      <form action="/register" method="post">

        {{-- agar tidak terjadi cross site request forgering atau request dari web yang tidak dikenal ke web kita, wajib tambahkan syntax dibawah ini --}}
        @csrf

        {{-- jangan lupa yang penting id dan name di dalam input --}}
        {{-- jika ada error tambahkan syntax @error dan akhir @enderror maka akan menambahkan class invalid --}}

        <div class="form-floating">
            <input type="text" name="name" class="form-control rounded-top 
            @error('name')
              is-invalid
            @enderror" id="name" placeholder="name" value="{{ old('name') }}">
            <label for="name">Name</label>

            {{-- warning dibawah nama, kasih variable $message udah otomatis sesuai dengan require di RegisterController --}}
            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
            {{-- end warning --}}
        </div>
        <div class="form-floating">
            <input type="text" name="username" class="form-control @error('username')
              is-invalid
            @enderror" id="username" placeholder="username" value="{{ old('username') }}">
            <label for="username">Username</label>

            @error('username')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror

        </div>
        <div class="form-floating">
          <input type="email" name="email" class="form-control 
          @error('email')
            is-invalid
          @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}">
          <label for="email">Email address</label>

          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating mb-3">
          <input type="password" name="password" class="form-control rounded-bottom
          @error('password')
            is-invalid
          @enderror" id="password" placeholder="password">
          <label for="password">Password</label>

          @error('password')
            <div class="invalid-feedback mb-3">
              {{ $message }}
            </div>
          @enderror
        </div>
    
        <button class="w-100 btn btn-lg btn-primary" type="       submit">Register</button>

        <small class="d-block text-center mt-3">Already registered ? <a href="/login">Login</a></small>

        <p class="mt-3 mb-3 text-muted text-center">&copy; by Taufik Qurrochman | 2022</p>

      </form>
    </main>
  
  </div>
</div>

{{-- end halaman login --}}

@endsection