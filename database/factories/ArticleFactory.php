<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $random_user = User::select('id')->inRandomOrder()->get();

        return [
            'article_type_id' => ArticleType::factory(),
            'user_id' => $random_user->first()->id,
            'title' => fake()->sentence,
            'intro' => fake()->paragraph,
            'content' => fake()->paragraphs(3, true),
            'meta_title' => fake()->sentence,
            'meta_description' => fake()->sentence,
            'slug' => fake()->slug(),
            'baseline' => fake()->paragraph,
        ];
    }
}
