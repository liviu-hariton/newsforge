<?php

namespace Tests\Unit;

use App\Models\ArticlePhotoGallery;
use App\Models\ArticlePhotoGalleryImage;
use Tests\TestCase;

class PhotoGalleryTest extends TestCase
{
    public function test_a_gallery_has_many_images(): void
    {
        $gallery = ArticlePhotoGallery::factory()->create();
        $image = ArticlePhotoGalleryImage::factory()->create();

        $this->assertCount(0, $gallery->images);

        $gallery->images()->attach($image);

        $this->assertCount(1, $gallery->fresh()->images);

        $this->assertTrue($gallery->images()->first()->is($image));
    }

    public function test_an_image_belongs_to_many_galleries(): void
    {
        $gallery = ArticlePhotoGallery::factory()->create();
        $image = ArticlePhotoGalleryImage::factory()->create();

        $this->assertCount(0, $image->galleries);

        $image->galleries()->attach($gallery);

        $this->assertCount(1, $image->fresh()->galleries);

        $this->assertTrue($image->galleries()->first()->is($gallery));
    }
}
