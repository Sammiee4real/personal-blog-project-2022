<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text($maxNbChars = 20),
            'full_text' => $this->faker->sentence(),
            'tags' => implode(',',[rand(1,10),rand(11,20),rand(21,30)]),
            'image_upload' => 'default.png',
            'user_id' => rand(1,2),
            'category_id' => rand(1,6),
            'created_at'=>now(),  
        ];
    }
}
