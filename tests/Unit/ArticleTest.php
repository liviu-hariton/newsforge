<?php

namespace Tests\Unit;

use App\Models\ArticleCategory;
use App\Models\Article as ArticleEntity;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    public function test_an_article_belongs_to_many_categories(): void
    {
        $article = ArticleEntity::factory()->create();
        $category = ArticleCategory::factory()->create();

        $this->assertCount(0, $category->articles);

        $category->articles()->attach($article);

        $this->assertCount(1, $category->fresh()->articles);

        $this->assertTrue($category->articles()->first()->is($article));
    }

    public function test_a_category_has_many_articles(): void
    {
        $article = ArticleEntity::factory()->create();
        $category = ArticleCategory::factory()->create();

        $this->assertCount(0, $article->categories);

        $article->categories()->attach($category);

        $this->assertCount(1, $article->fresh()->categories);

        $this->assertTrue($article->categories()->first()->is($category));
    }

    public function test_article_has_a_type(): void
    {
        $article = ArticleEntity::factory()->create();

        $this->assertNotNull($article->type);
    }

    public function test_article_type_has_many_articles(): void
    {
        $article = ArticleEntity::factory()->create();

        $this->assertCount(1, $article->type->articles);
    }

    public function test_article_has_a_user(): void
    {
        $article = ArticleEntity::factory()->create();

        $this->assertNotNull($article->user);
    }
}
