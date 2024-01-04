<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactForm extends Model
{
    // Disable timestamps
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'name_as_placeholder', 'description', 'notes', 'contact_field_type_id', 'required', 'max_length', 'extensions', 'columns', 'active', 'sort_order'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ContactFieldType::class, 'contact_field_type_id');
    }
}
