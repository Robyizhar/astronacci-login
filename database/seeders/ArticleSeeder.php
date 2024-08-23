<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use DB;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        DB::table('videos')->delete();
        DB::table('articles')->delete();
        for ($i=1; $i < 11; $i++) {
            $article = Article::create([
                'title' => $faker->unique()->sentence(),
                'text' => implode("\n\n", $faker->paragraphs(10))
            ]);

            Video::create([
                'article_id' => $article->id,
                'title' => 'storage/video/'.$i.'.mp4'
            ]);
        }
    }
}