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
        Schema::create('article_photo_galleries', function (Blueprint $table) {
            $table->id();

            // author
            $table->unsignedBigInteger('user_id')
                ->index('user_id')
                ->nullable()
                ->comment('The user who created the gallery');

            // content
            $table->string('name');
            $table->text('description')->nullable();

            // seo
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('slug')->unique();
            $table->tinyText('baseline')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_photo_galleries');
    }
};
