<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;
    public function definition()
    {
        $faker = \Faker\Factory::create('id_ID');
        return [
            'title' => $faker->unique()->sentence(),
            'text' => implode("\n\n", $faker->paragraphs(15))
        ];
    }
}
