<?php

namespace Database\Factories;

use App\Models\ArticlePhotoGallery;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticlePhotoGalleryFactory extends Factory
{
    protected $model = ArticlePhotoGallery::class;

    public function definition(): array
    {
        $random_user = User::select('id')->inRandomOrder()->get();

        return [
            'user_id' => $random_user->first()->id,
            'name' => fake()->sentence,
            'description' => fake()->paragraph,
            'meta_title' => fake()->sentence,
            'meta_description' => fake()->sentence,
            'slug' => fake()->slug,
            'baseline' => fake()->paragraph,
        ];
    }
}
