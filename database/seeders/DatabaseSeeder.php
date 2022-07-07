<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// untuk memangil model user
use App\Models\User;
// untuk memangil model category
use App\Models\Category;
// untuk memangil model post
use App\Models\Post;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

            // User::create([
            //     'name' => 'Taufik',
            //     'username' => 'taufik',
            //     'email' => 'taufik@gmail.com',
            //     'password' => bcrypt('12345')
            // ]);
            // menambahkan user dengan faker
            User::factory(5)->create();

            // kalau mau jalankan php artisan db:seed yang cateogry dicomment dikarenkan tidak boleh duplicate datanya
            Category::create([
                'name' => 'Web Programming',
                'slug' => 'web-programming'
            ]);

            Category::create([
                'name' => 'Mobile Developer',
                'slug' => 'mobile-developer'
            ]);

            Category::create([
                'name' => 'SEO',
                'slug' => 'seo'
            ]);

            Category::create([
                'name' => 'Personal',
                'slug' => 'personal'
            ]);

            // menambahakan post dengan faker, settingan faker ada diPostFactory 
            Post::factory(20)->create();
    }
}
