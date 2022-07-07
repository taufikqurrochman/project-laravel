<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
// agar function slug jalan
use \Cviebrock\EloquentSluggable\Services\SlugService;
// agar function storage jalan
use Illuminate\Support\Facades\Storage;
// agar function str::limit jalan
use Illuminate\Support\Str;


class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // categories pilih ke model categories dikarenakan ada input drop down yang butuh table category
        return view('dashboard.posts.create',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // parameter validasi
        $validateData = $request->validate([
            'title' => 'required|max:100',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            // validasi image harus gambar, file dan max kapasitas 5mb
            'image' => 'image|file|max:5000',
            'body' => 'required',
        ]);

        // jika ada maka akan distore ke post-image
        if($request->file('image'))
        {
            // syntax create image $request bla bla, simpan di storage folder post-image
            $validateData['image'] = $request->file('image')->store('post-image');
        }
        
        // untuk insert data ke database
        $validateData['user_id'] = auth()->user()->id;
        // limit dari body max 50 karakter dan strip_tags function php untuk menghilangkan tag diinputan
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        //untuk create ditable post
        // jangan lupa cek fillabel di model postnya
        Post::create($validateData);

        //redirect ke halaman post dengan warning success
        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // pilih model category dikarenakan ada menu dropdown yang butuh model category
        return view('dashboard.posts.edit', [
            // Post diatas disimpan dalam variable $post, $post menunjuk ke array post
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // bikin rules nanti validasi dibawah
        $rules = [
            'title' => 'required|max:100',
            'category_id' => 'required',
            // validasi image harus gambar, file dan max kapasitas 5mb
            'image' => 'image|file|max:5000',
            'body' => 'required',
        ];

        // untuk mencegah error duplikat slug
        // request adalah data yang ada diform dan post adalah data yang ada didatabase
        // jika slug berubah denga slug yang ada didatbase maka rule unique jalan
        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }

        // parameter validasi
        $validateData = $request->validate($rules);

        // jika ada maka akan distore ke post-image
        if($request->file('image'))
        {
            // penambahan hapus gambar lama lalu dibawah insert data baru, cara agar tau gambar ditambah form hidden diinputan gambar
            if($request->oldImage){
                // cara hapus dengan fungsion storage dan tambahkan name space diatas
                Storage::delete($request->oldImage);
            }

            // syntax create image $request bla bla, simpan di storage folder post-image
            $validateData['image'] = $request->file('image')->store('post-image');
        }

        // syntax update bedasarkan id
        Post::where('id', $post->id)->update($validateData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        // validasi hapus gambar
        if($post->image){
            // cara hapus dengan fungsion storage dan tambahkan name space diatas
            Storage::delete($post->image);
        }
        Post::destroy($post->id);
        //redirect ke halaman post dengan warning success
        return redirect('/dashboard/posts')->with('success', 'Delete sucess');
    }

    // function slug
    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
