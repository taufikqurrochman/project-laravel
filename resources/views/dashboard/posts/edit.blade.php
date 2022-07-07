@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Edit Post</h1>
    </div>


    {{-- form create posts --}}
    <div class="col-lg-7">
        {{-- 
            form action akan mengarah ke web route::resource begitu halaman /dashboard/posts dan method post maka akan mengarah ke dashboardpostcontroller function store
            
            begitu halaman /dashboard/posts dan method get maka akan mengarah ke dashboardpostcontroller function index

            jika method delete maka akan langsung ke function destroy
        --}}
        <form method="post" action="/dashboard/posts/{{ $post->slug }}" enctype="multipart/form-data">

            {{-- bajak method supaya ngarah ke dashboardpostcontroller function update --}}
            @method('put')
            {{-- end bajak --}}

            @csrf
            {{-- title --}}
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control 
              @error('title')
                  is-invalid
              @enderror" 
              {{-- fungsi dari laravel old, title. Jadi jika tidak ada data old maka post menampilkan title --}}
              id="title" name="title" value="{{ old('title', $post->title) }}">
              {{-- pesan error --}}
              @error('title')
                <div class="alert alert-light" role="alert">
                    {{ $message }}
                </div>
              @enderror
            </div>
            {{-- end title --}}

            {{-- slug --}}
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control
                @error('slug')
                    is-invalid
                @enderror" 
                id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
                {{-- pesan error --}}
                @error('slug')
                    <div class="alert alert-light" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- end slug --}}

            {{-- validasi category hanya didashboardpostcontroller saja tetapi diform ini tidak dibuat --}}
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category_id">

                    @foreach ($categories as $category)
                        {{-- agar kategori tidak perlu pilih lagi --}}
                        @if (old('category_id', $post->category_id) == $category->id)
                            <option value="{{ $category->id }}" selected>
                                {{ $category->name }}
                            </option>
                        @else
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endif
                        {{-- end of kategori --}}
                    @endforeach
                    
                  </select>
            </div>

            {{-- input gambar --}}
            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                {{-- inputan hidden agar tau gambar lama yang dapat dihapus --}}
                <input type="hidden" name="oldImage" value="{{ $post->image }}">

                {{-- kondisi untuk menampilkan gambar --}}
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-preview img-fluid mb-2 rounded">
                @else
                    {{-- image preview --}}
                    <img class="img-preview img-fluid mb-2 rounded">
                    {{-- end of image preview --}}
                @endif


                <input class="form-control
                @error('image')
                    is-invalid
                @enderror" type="file" id="image" name="image" onchange="previewImage()">
                {{-- penambahan onchange untuk preview image --}}
                @error('image')
                    <div class="alert alert-light" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- end input gambar --}}

            {{-- excerpt diskip karena akan ngambil beberapa text dari body  --}}

            {{-- body --}}
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                    <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                    <trix-editor input="body"></trix-editor>

                    {{-- dikarenakan trix bukan dari bootstrap maka error hanya menggunakan tag p saja --}}
                    @error('body')
                        <div class="alert alert-light" role="alert">
                           {{ $message }}
                        </div>
                    @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-3">Update Post</button>
          </form>
    </div>

    {{-- end form create --}}

    {{-- javascript agar function sluggable dipost dapat jalan --}}
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        // agar fungsi attachment diform trix tidak jalan
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        });

        // script buat preview image
        function previewImage(){
            // script untuk preview gambar, tangkap gambar dari id image (inputan)
            const image = document.querySelector('#image');
            // cek class = img-preview
            const imgPreview = document.querySelector('.img-preview');

            // ubah display image dari inline menjadi block
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(ofREvent){
                imgPreview.src = ofREvent.target.result;
            }
        }
        // end scrip preview image
    </script>
    {{-- end javascript --}}
@endsection