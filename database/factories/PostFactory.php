<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // untuk database factory table post
            // mt_rand fungsi untuk random dengan parameter
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            // agar paragraph dapat tambahan <p> dan implode
            // 'body' => '<p>' . implode('</p><p>',$this->faker->paragraphs(mt_rand(5,10))) . '</p>',

            // atau menggunakan collect agar dapat menggunakan tag p dengan map
            'body' => collect($this->faker->paragraphs(mt_rand(5,10)))->map(fn($p) => "<p>$p</p>")->implode(''),

            'user_id' => mt_rand(1,5),
            'category_id' => mt_rand(1,4)
        ];
    }
}
