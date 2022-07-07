<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// agar terhubung dengan model post
use App\Models\Post;

// agar terhubung dengan model category
use App\Models\Category;

// agar terhubung dengan model user
use App\Models\User;
// use PharIo\Manifest\Author;

class PostController extends Controller
{
    // method dengan nama index, method ini untuk blog
    public function index()
    {
        // agar title dipost menjadi dinamis, maka $title dibuat kosong dahulu
        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            // maka title akan berubah
            $title = 'in ' . $category->name;
        }

        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            // maka title akan berubah
            $title = 'by ' . $author->name;
        }

        return view('posts',[
            "title" => "All Posts " . $title,
            // kirim link ke navbar jika active = $active maka class 'active nyala'
            "active" => 'posts',
            // connect ke model post yang static
            // "posts" => Post::all()
            // latest get agar menampilkan semua post berdasarkan yang paling baru dipost
            // eager post agar mengatasi masalah n+1 problem / agar query tidak diambil banyak ditambahkan syntax with([nama model]) post tidak dipanggil dikarenakan semua relasi ke post dan pemanggilan data juga ke post
            // "posts" => Post::with(['author', 'category'])->latest()->get()
            // with dipindahkan ke model post
            // "posts" => Post::latest()->get()

            // tambahan filter akan mengecek ke Model Post.php function scopefilter, request pakai array
            // get() diganti dengan pagination agar ada halaman dipost max 7 item saja
            // agar pagination mencek query maka tambahkan method withQueryString
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
    }

    //methode untuk single post dengan id $post didapat dari route
    //sekarang model diikat dengan route $post, route bisa dicek diweb.php
    public function show(Post $post)
    {
        return view('post', [
            // title disini bukan judul tapi halamannya, untuk ganti title di main.blade.php
            "title" => "Single Post",
            "active" => 'posts',
            // cek ke model post dan find data berdasarkan slug
            "post" => $post
        ]);
    }
}
