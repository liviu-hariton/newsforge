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
        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();

            // parent
            $table->unsignedBigInteger('parent_id')->default(0);

            // content
            $table->string('name');
            $table->text('description')->nullable();

            // seo
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('slug')->unique();
            $table->mediumText('baseline')->nullable();

            // cover
            $table->string('cover_image')->nullable();
            $table->string('cover_image_title')->nullable();
            $table->string('cover_image_alt')->nullable();

            // stats
            $table->unsignedBigInteger('views_count')->default(0);

            // sorting
            $table->integer('sort_order')
                ->default(0)
                ->comment('Used for sorting in menus, if the menus have custom sorting set');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_categories');
    }
};
