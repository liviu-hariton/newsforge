<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'article_type_id');
    }
}
