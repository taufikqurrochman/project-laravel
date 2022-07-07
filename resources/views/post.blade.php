
{{-- var dump --}}
{{-- @dd($post) --}}

{{-- memanggil layouts main.blade.php --}}
@extends('layouts.main')

{{-- untuk merubahan container yang ada dimain.blade.php --}}
@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- new_post ditampung dalam $post jadi yang dipanggil $post di route single post --}}
                {{-- $post ini didapat dari "post" dari function show di PostController --}}
                <h2 class="text-center">{{ $post->title }}</h2>

                {{-- author --}}
                {{-- agar menampilkan post berdasarkan nama category --}}
                <p class="text-center">By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
                {{-- end author --}}

                
                @if ($post->image)
                {{-- post image disebelah storage tidak perlu ditulis karena sudah terbawa di database --}}
                    <div style="max-height: 1200px; max-width: 400px overflow: hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top mb-3 img-fluid mt-3" alt="{{ $post->category->name }}">
                    </div>
                @else
                    <img src="https://source.unsplash.com/random/1200x400/?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                @endif


                {{-- untuk menghilangkan tag p, sesuai dengan kondisi database --}}
                <article>
                    {!! $post->body !!}
                </article>
                {{-- kembali ke posts.blade memangil route di web /posts --}}
                <a href="/posts" class="text-decoration-none d-block mt-2 mb-2">Back to posts</a>
            </div>
        </div>
    </div>

@endsection