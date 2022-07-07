<?php


// untuk connect dengan model User

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Models\Category;

use Illuminate\Support\Facades\Route;

// agar tersambung dengna PostController
use App\Http\Controllers\PostController;
// agar tersambung dengan LoginController
use App\Http\Controllers\LoginController;
// agar tersambung dengan RegisterController
use App\Http\Controllers\RegisterController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// rute ke home
Route::get('/', function () {
    return view('home',[
        "title" => "Home",
        'active' => 'home'
    ]);
});

// rute ke about dan kirim data via array
Route::get('/about', function () {
    return view('about',[
        "title" => "About",
        "name" => "Monkey D Luffy",
        "email" => "luffy@gmail.com",
        "image" => "luffy.jpeg",
        'active' => 'about'
    ]);
});

// route nyambung ke postcontroller dengan method index /posts ini nyambung ke navbar
Route::get('/posts', [PostController::class, 'index']);

//route nyambung ke PostController dengan method show {post} kirim ke post controller single post
// jika hanya {post} maka default dari database akan kirim hanya id
// {post:slug} menangkap parameter dari posts.blade $post->slug dari a href
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// route untuk categories
Route::get('/categories', function(){
    return view('categories',[
        'title' => 'Post Category',
        'active' => 'categories',
        // untuk mengambil semua post berdasarkan kategori
        'categories' => Category::all()
    ]);
});


// route ke halamana login
// middleware untuk mencek apakah user sudah login atau belum, jika akses belum login maka guest jika sudah login maka auth bisa dicek dihttp -> kernel.php
// untuk guest otomatis ke /home maka harus dicek provider -> route service provider
// agar tidak error route login maka route login ini harus dideclare dengan cara ->name('login)
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// validasi halaman login method post
Route::post('/login', [LoginController::class, 'authenticate']);


// jika methode post dan mengarah ke logout
Route::post('logout', [LoginController::class, 'logout']);


//route ke halaman register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// form index.blade.php register method post jadi dibuat rute dengan post
Route::post('/register', [RegisterController::class, 'store']);

// route ke halaman dashboard
Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');

// route check ke dashboardpostcontroller function checkslug
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

// route untuk crud ke dashboardpostcontroller
// dikarenakan pakai resource maka tidak bisa pakai route model binding ex /dashboard/posts/{post:slug}
// agar slug di index.blade yang posts jalan maka di model Post.php harus dijalankan function getRouteKeyName
// resource akan otomatis memilih function didashboardpostcontroller
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// route yang mengarah ke controller category, hanya yang tidak diperlukan adalah function show
// middleware auth dipindahkan ke admincategorycontroller
//middleware admin custom didapat dari IsAdmin dan didaftarkan dikernel folder middleware
Route::resource('/dashboard/categories', 
AdminCategoryController::class)->except('show');
// ->middleware('admin');


// DIMODEL POST SUDAH DITANGANI JADI ROUTE INI TIDAK TERPAKAI
// route yang mengarah ke categori
// category slug langsung cek ke databae category dan table slug
// function disini adalah closure
// $category difunction harus sama dengan category yang ada diget
// category:slug didapat dari posts.blade liat link a href
// Route::get('/categories/{category:slug}', function(Category $category){
//     // kembali ke view category dan $category->posts ini harus punya relasi dlu dimodelsnya belongsto hasmany dll
//     // return view posts akan mengarah ke view posts.blade
//     return view('posts',[
//         'title' => "Post by Category : $category->name",
//         // route model binding agar tidak ada masalah n+1 problem ditambahkan load()
//         'posts' => $category->posts->load('category', 'author'),
//         'active' => 'categories'
//     ]);
// });

// DIMODEL POST SUDAH DITANGANI JADI ROUTE INI TIDAK TERPAKAI
// route untuk mengarah ke halaman author, route model binding ada diisi function
// karena yang dikirim adalah username maka harus diketik user:username, jika hanya id cukup ketik {user}
// author disini memanggil dari model Post
// Route::get('/authors/{author:username}', function(User $author){
//     return view('posts',[
//         'title' => "Author by : $author->name",
//         // untuk route model binding maka ditambahkan load()
//         'posts' => $author->posts->load('category', 'author'),
//         'active' => 'posts'
//     ]);
// });
