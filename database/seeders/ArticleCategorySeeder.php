<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleCategory::create(['name' => 'Politics']);
        ArticleCategory::create(['name' => 'Health']);
        ArticleCategory::create(['name' => 'Religion']);
        ArticleCategory::create(['name' => 'Wealth']);
        ArticleCategory::create(['name' => 'Sports']);
        ArticleCategory::create(['name' => 'Education']);
    }
}
