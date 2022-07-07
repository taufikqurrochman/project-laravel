@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                {{-- new_post ditampung dalam $post jadi yang dipanggil $post di route single post --}}
                {{-- $post ini didapat dari "post" dari function show di PostController --}}
                <h2 class="mt-3">{{ $post->title }}</h2>

                {{-- button --}}
                <a href="/dashboard/posts" class="btn btn-primary"><span data-feather="arrow-left"></span> Back to my posts</a>

                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>

                {{-- delete harus pakai form --}}
                {{-- dikarenakan form ada block harus dirubah jadi inline --}}
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                    @csrf
                    {{-- diarah methode didashboard post ke destroy --}}
                    @method('delete')

                    {{-- tambahkan javascript pop up are u sure ? --}}
                    <button class="btn bg-danger text-white" onclick="return confirm('Are you sure ?')">
                        <span data-feather="trash-2"></span> Delete
                    </button>
                </form>
                {{-- end button --}}

                {{-- jika ada gambar maka akan upload gambar, jika tidak ada akan melihat dari unsplash --}}
                @if ($post->image)
                {{-- post image disebelah storage tidak perlu ditulis karena sudah terbawa di database --}}
                    <div style="max-height: 350px; overflow: hidden">
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top mb-3 img-fluid mt-3" alt="{{ $post->category->name }}">
                    </div>
                @else
                    <img src="https://source.unsplash.com/random/1200x400/?{{ $post->category->name }}" class="card-img-top mb-3 img-fluid mt-3" alt="{{ $post->category->name }}">
                @endif


                {{-- untuk menghilangkan tag p, sesuai dengan kondisi database --}}
                <article>
                    {!! $post->body !!}
                </article>
            </div>
        </div>
    </div>
@endsection