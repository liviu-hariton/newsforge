<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactFieldType extends Model
{
    // Disable timestamps
    public $timestamps = false;

    protected $fillable = [
        'name', 'type', 'icon'
    ];

    public function fields(): HasMany
    {
        return $this->hasMany(ContactForm::class);
    }
}
