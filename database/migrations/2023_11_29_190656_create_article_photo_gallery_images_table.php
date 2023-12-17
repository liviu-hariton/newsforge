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
        Schema::create('article_photo_gallery_images', function (Blueprint $table) {
            $table->id();

            // author
            $table->unsignedBigInteger('user_id')
                ->index('user_id')
                ->nullable()
                ->comment('The user who uploaded the image');

            $table->string('file');

            // seo
            $table->string('title')->nullable();
            $table->string('alt')->nullable();

            // sorting
            $table->integer('sort_order')
                ->default(0)
                ->comment('Used for sorting in galleries, if the galleries have custom sorting set');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_photo_gallery_images');
    }
};
