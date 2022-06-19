<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleTags>
 */
class ArticleTagsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = ArticleTags::class;

    public function definition()
    {
        return [
            'name' => strtolower( $this->faker->unique->text($maxNbChars = 7) ),
            'created_at'=>now(),
        ];
    }
}
