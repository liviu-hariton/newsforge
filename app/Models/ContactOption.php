<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactOption extends Model
{
    // Disable timestamps
    public $timestamps = false;

    protected $fillable = [
        'value', 'latitude', 'longitude', 'active', 'sort_order', 'contact_option_type_id'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ContactOptionType::class, 'contact_option_type_id');
    }
}
