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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->integer('article_type_id')->index('article_type_id')->nullable();

            // author
            $table->unsignedBigInteger('user_id')
                ->index('user_id')
                ->nullable()
                ->comment('The main author of the article');

            // content
            $table->string('title');
            $table->text('intro')->nullable();
            $table->longText('content')->nullable();

            // seo
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('slug')->unique();
            $table->mediumText('baseline')->nullable();

            // cover
            $table->string('cover_image')->nullable();
            $table->string('cover_image_title')->nullable();
            $table->string('cover_image_alt')->nullable();
            $table->string('cover_video')
                ->nullable()
                ->comment('Youtube or Vimeo video ID or URL');

            // status
            $table->boolean('is_published')
                ->default(false)
                ->comment('If not published, only visible to author');
            $table->timestamp('published_from')
                ->nullable()
                ->comment('If set, article will be published after this date');
            $table->timestamp('published_until')
                ->nullable()
                ->comment('If set, article will be unpublished after this date');
            $table->unsignedBigInteger('published_by_user_id')
                ->index('published_user_id')
                ->nullable()
                ->comment('The user who actually published the article');

            // visibility
            $table->boolean('is_private')
                ->default(false)
                ->comment('Not displayed in lists, available only to logged in users');
            $table->boolean('is_secret')
                ->default(false)
                ->comment('Not displayed in lists, available only by direct link');
            $table->boolean('is_archived')->default(false);
            $table->boolean('is_featured')
                ->default(false)
                ->comment('Displayed highlighted in list');
            $table->boolean('is_pinned')
                ->default(false)
                ->comment('Displayed on top of the list');
            $table->boolean('is_hero')
                ->default(false)
                ->comment('Displayed in big format on top of the list');

            // stats
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('likes_count')->default(0);
            $table->unsignedBigInteger('dislikes_count')->default(0);
            $table->unsignedBigInteger('comments_count')->default(0);

            // sorting
            $table->integer('sort_order')
                ->default(0)
                ->comment('Used for sorting in lists, if the lists have custom sorting set');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
