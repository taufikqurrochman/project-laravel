
{{-- memanggil layouts main.blade.php --}}
@extends('layouts.main')

{{-- untuk merubahan container yang ada dimain.blade.php --}}
@section('container')
    <h1>Halaman About</h1>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="200">
@endsection