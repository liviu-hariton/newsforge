<?php

namespace App\Models;

use App\Traits\ModelCache;
use App\Traits\UniqueSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactOption extends Model
{
    use UniqueSlug, ModelCache;

    // Disable timestamps
    public $timestamps = false;

    protected $fillable = [
        'value', 'latitude', 'longitude', 'active', 'sort_order', 'contact_option_type_id'
    ];

    // Set the cache key name
    static public string $cache_key = 'contact_methods';

    public function type(): BelongsTo
    {
        return $this->belongsTo(ContactOptionType::class, 'contact_option_type_id');
    }
}
