<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactOptionType extends Model
{
    // Disable timestamps
    public $timestamps = false;

    protected $fillable = [
        'name', 'icon'
    ];

    public function options(): HasMany
    {
        return $this->hasMany(ContactOption::class);
    }
}
