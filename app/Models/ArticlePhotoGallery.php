<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ArticlePhotoGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'meta_title',
        'meta_description',
        'slug',
        'baseline',
    ];

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(ArticlePhotoGalleryImage::class, 'article_photo_gallery_image');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
