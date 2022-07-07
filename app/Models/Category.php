<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // jagain id agar tidak dapat diisi
    protected $guarded = ['id'];
    // agar dapat diinput post::create dll
    protected $fillable = ['name', 'slug'];

    // untuk menghubungkan category dengan post
    public function posts()
    {
        // 1 category bisa punya banyak post jadi relasinya hasmany
        return $this->hasMany(Post::class);
    }
}
