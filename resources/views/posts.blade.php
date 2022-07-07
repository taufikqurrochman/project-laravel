{{-- dump and die untuk melihat object dari array seperti var dump --}}
{{-- @dd($posts) --}}


{{-- memanggil layouts main.blade.php --}}
@extends('layouts.main')

{{-- untuk merubahan container yang ada dimain.blade.php --}}
@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    {{-- fitur search --}}
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts">
                {{-- penambahan search validasi dari category, jika sudah memilih salah satu kategori maka search hanya akan mencari dikategori tsb --}}
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif   

                {{-- penambahan search validasi dari author, jika sudah memilih salah satu author maka search hanya akan mencari diauthor tsb --}}
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif

                <div class="input-group mb-3">
                    {{-- value request supaya ketikan search tetap muncul --}}
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit" id="">Search</button>
                  </div>
            </form>
        </div>
    </div>
    {{-- end fitur search --}}


    {{-- hero section --}}
    @if($posts->count())
        {{-- image --}}
        <div class="card mb-3">
            {{-- jika ada gambar maka akan upload gambar, jika tidak ada akan melihat dari unsplash --}}
            @if ($posts[0]->image)
            {{-- post image disebelah storage tidak perlu ditulis karena sudah terbawa di database --}}
                <div style="max-height: 350px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
                </div>
            @else
                <img src="https://source.unsplash.com/random/1200x400/?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
            @endif

            <div class="card-body text-center">
                {{-- title --}}
                <h2 class="card-title">
                    <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a>
                </h2>
                {{-- end of title --}}

                {{-- author --}}
                <small class="text-muted">
                    <p>
                        By <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a>

                        {{-- Last Update agar mudah dibaca tambah syntax diffForHumans --}}
                        {{ $posts[0]->created_at->diffForHumans() }}
                        {{-- end Last Update --}}
                    </p>
                </small>
                {{-- end author --}}

                <p class="card-text">{{ $posts[0]->excerpt }}</p>

                <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read More</a>
            </div>
          </div>
          {{-- end of image --}}
    {{-- end of hero section --}}

    {{-- Halaman Post --}}
    <div class="container">
        <div class="row">
            {{-- looping agar semua data muncul --}}
            {{-- $posts ini didapat dari postcontroller function index variable "posts" --}}
            {{-- tambahan skip 1 agar post yang pertama diskip --}}
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">

                    {{-- category label --}}
                    {{-- background colour rgba untuk transparant --}}
                    <div class="position-absolute px-2 py-2 text-white" style="background-color: rgba(0, 0, 0, 0.5)">
                        <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none text-white">{{ $post->category->name }}</a>
                    </div>
                    {{-- end category label --}}


                    {{-- jika ada gambar maka akan upload gambar, jika tidak ada akan melihat dari unsplash --}}
                    @if ($post->image)
                    {{-- post image disebelah storage tidak perlu ditulis karena sudah terbawa di database --}}
                        <div style="max-height: 500px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->category->name }}">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/random/500x400/?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                    @endif


                    <div class="card-body">
                        <h5 class="card-title">
                            {{-- akan menampilkan slug dari route --}}
                            {{-- sekarang yang dikirim slug bukan id lagi --}}
                            <a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{  $post->title  }}</a>
                        </h5>

                        {{-- author --}}
                        <small class="text-muted">
                            <p>
                                By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a>

                                {{-- Last Update agar mudah dibaca tambah syntax diffForHumans --}}
                                {{ $post->created_at->diffForHumans() }}
                                {{-- end Last Update --}}
                            </p>
                        </small>
                        {{-- end author --}}

                      <p class="card-text">{{ $post->excerpt }}</p>

                      <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read more</a>

                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- End Halaman Post --}}

    {{-- jika postingan tidak ditermukan maka akan muncul pesan dibawah ini --}}
    @else
        <p class="text-center fs-4">No Post Found</p>
    @endif

    {{-- link pagination --}}
    {{-- dikarenakan paginator menggunakan bootstrap maka harus dideclare di App\Providers\AppServiceProvider cek diweb laravel cari bootstrap --}}
    {{-- pembatasan pagination ada di postcontroller.php --}}
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    {{-- end link pagination --}}

@endsection