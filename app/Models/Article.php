<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'intro',
        'content',
        'meta_title',
        'meta_description',
        'slug',
        'baseline',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_category');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ArticleType::class, 'article_type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
