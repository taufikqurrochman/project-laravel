<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    //  yang boleh diisi secara masal atau $fillable
    // protected $fillable = [
    //     'name',
    //     'username',
    //     'email',
    //     'password',
    // ];

    // guarded kebalikan dari fillabel, kalo guarded yang ga boleh diisi, fillabel yang boleh diisi
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // function untuk menghubungkan user dengan post
    public function posts()
    {
        // satu user boleh punya banyak post
        return $this->hasMany(Post::class);
    }
}
