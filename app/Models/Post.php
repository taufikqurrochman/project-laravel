<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//  agar slug otomatis
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    // agar slug otomatis
    use Sluggable;

    // agar dapat diinput post::create dll
    //protected $fillable = ['title', 'category_id' ,'slug', 'excerpt', 'body'];
    // agar id tidak boleh diisi
    protected $guarded = ['id'];

    // n+1 problem with dipindahkan dari post controller ke model
    protected $with = ['category', 'author'];

    // function search, dapat dari postcontroller function index
    public function scopeFilter($query, array $filters)
    {
        // jika ada pencarian maka akan masuk ke sini, maksud isset disini ngecek klo ada ambil searchnya kalo ga ada false
        // if(isset($filters['search']) ? $filters['search'] : false)
        // {
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%')->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        // syntax php versi 7 dan diatasnya, jika ada pilih filter search jika tidak ada maka false klo bener maka function jalan
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('title', 'like', '%' . $search . '%');
            // ->orWhere('body', 'like', '%' . $search . '%');
        });

        // untuk penambahan validasi jika halaman post dipilih  berdasarkan category, query disini direlasi dengan table category
        $query->when($filters['category'] ?? false, function($query, $category){
            // category dibawah didapat dari function category dibawah agar $category diatas dapat dipakai maka menggunakan syntax use
            return $query->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
        });

        // untuk penambahan validasi jika halaman author dipilih, maka search akan berdasarkan author
        $query->when($filters['author'] ?? false, function($query, $author){
            return $query->whereHas('author', function($query) use ($author){
                $query->where('username', $author);
            });
        });
    }

    // function untuk menghubungkan post dengan category
    public function category()
    {
        // satu post hanya boleh punya satu category relasi belongsto
        return $this->belongsTo(Category::class);
    }

    // function untuk menghubungkan post dengan database user
    // dikarenakan diroute web diganti jadi author maka harus ditambahkan alias user_id
    public function author()
    {
        // satu post hanya boleh punya 1 user
        // ditambahkan user_id karena alias untuk authornya
        return $this->belongsTo(User::class, 'user_id');
    }


    // agar route diweb yang pakai resource bisa pakai route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // dicreate blade agar slug otomatis dibuat berdasarkan title maka jalankan function
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
