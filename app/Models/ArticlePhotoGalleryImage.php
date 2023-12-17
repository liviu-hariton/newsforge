<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ArticlePhotoGalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'title',
        'alt',
    ];

    public function galleries(): BelongsToMany
    {
        return $this->belongsToMany(ArticlePhotoGallery::class, 'article_photo_gallery_image');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
