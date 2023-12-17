<?php

namespace Database\Factories;

use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleCategoryFactory extends Factory
{
    protected $model = ArticleCategory::class;

    public function definition(): array
    {
        $parent_id = 0;

        if (ArticleCategory::count() > 2) {
            $random_row = ArticleCategory::select('id')->inRandomOrder()->get();

            $parent_id = $random_row->first()->id;
        }

        return [
            'parent_id' => $parent_id,
            'name' => fake()->sentence,
            'description' => fake()->paragraph,
            'meta_title' => fake()->sentence,
            'meta_description' => fake()->sentence,
            'slug' => fake()->slug,
            'baseline' => fake()->paragraph,
        ];
    }
}
