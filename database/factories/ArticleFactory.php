<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;
    public function definition()
    {
        $fakerID = \Faker\Factory::create('id_ID');
        return [
            'title' => $fakerID->unique()->sentence(),
            'text' => implode("\n\n", $fakerID->paragraphs(15))
        ];
    }
}
