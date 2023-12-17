<?php

namespace Database\Factories;

use App\Models\ArticlePhotoGalleryImage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticlePhotoGalleryImageFactory extends Factory
{
    protected $model = ArticlePhotoGalleryImage::class;

    public function definition(): array
    {
        $random_user = User::select('id')->inRandomOrder()->get();

        return [
            'user_id' => $random_user->first()->id,
            'file' => fake()->word.'.'.fake()->fileExtension(),
            'title' => fake()->sentence,
            'alt' => fake()->sentence,
        ];
    }
}
