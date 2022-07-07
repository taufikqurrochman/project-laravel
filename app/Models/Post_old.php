<?php

namespace App\Models;

class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul post pertama",
            "slug" => "judul-post-pertama",
            "author" => "Taufik Qurrochman",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas deserunt, laboriosam, praesentium, ipsum amet omnis suscipit voluptates adipisci quis quas odio? Qui, reiciendis accusantium voluptate optio quam distinctio quod vitae laudantium facere dicta placeat, eaque magni esse ab molestiae beatae ullam ex saepe! Sunt rerum at est itaque officia nam cupiditate temporibus, ullam consectetur facilis maiores hic neque, accusamus corrupti vero voluptas quaerat corporis expedita autem sapiente doloremque! Voluptatibus optio repudiandae autem corrupti! Voluptatum itaque, neque pariatur impedit delectus consequatur in omnis voluptas molestiae distinctio eos eligendi a asperiores placeat voluptatibus harum nisi voluptatem, excepturi iure cupiditate ab, deleniti ipsa?"
        ],
        [
            "title" => "Judul post kedua",
            "slug" => "judul-post-kedua",
            "author" => "Riska Dwi Wijayanti",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas deserunt, laboriosam, praesentium, ipsum amet omnis suscipit voluptates adipisci quis quas odio? Qui, reiciendis accusantium voluptate optio quam distinctio quod vitae laudantium facere dicta placeat, eaque magni esse ab molestiae beatae ullam ex saepe! Sunt rerum at est itaque officia nam cupiditate temporibus, ullam consectetur facilis maiores hic neque, accusamus corrupti vero voluptas quaerat corporis expedita autem sapiente doloremque! Voluptatibus optio repudiandae autem corrupti! Voluptatum itaque, neque pariatur impedit delectus consequatur in omnis voluptas molestiae distinctio eos eligendi a asperiores placeat voluptatibus harum nisi voluptatem, excepturi iure cupiditate ab, deleniti ipsa?"
        ]
    ];

    // public function untuk posts/blog
    //tambahan array collection, agar fungsi firstwhere dapat dieksekusi
    public static function all(){
        return collect(self::$blog_posts);
    }

    // public function untuk post/single post
    public static function find($slug){
        $posts = static::all();

            // //declare varible kosong
            // $post =[];
            // //ambil posts yang banyak lalu declare as $p dan cek berdasarkan slug
            // foreach($posts as $p){
            //     // cek data blog_posts lalu diseleksi berdasarkan slug
            //     if($p["slug"] == $slug){
            //         // hasilnya disimpan dalam variable $post
            //         $post = $p;
            //     }
            // }

        //untuk menseleksi hanya perlu sintax firstWhere
        return $posts->firstWhere('slug', $slug);
    }
}
