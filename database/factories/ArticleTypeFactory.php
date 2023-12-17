<?php

namespace Database\Factories;

use App\Models\ArticleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleTypeFactory extends Factory
{
    protected $model = ArticleType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence,
            'description' => fake()->paragraph,
        ];
    }
}
