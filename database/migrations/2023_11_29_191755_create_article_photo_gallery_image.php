<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_photo_gallery_image', function (Blueprint $table) {
            $table->unsignedBigInteger('article_photo_gallery_id')->index('article_photo_gallery_id');
            $table->unsignedBigInteger('article_photo_gallery_image_id')->index('article_photo_gallery_image_id');

            $table->comment('Pivot table for article photo gallery and image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_photo_gallery_image');
    }
};
