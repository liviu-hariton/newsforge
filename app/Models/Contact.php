<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'from_name',
        'from_email',
        'subject',
        'message',
        'headers',
        'attachments',
        'ipv4',
    ];

    protected $casts = [
        // Cast to array as it is declared as a JSON field, so we can use it as an array
        'attachments' => 'array',
    ];

    protected array $dates = [
        'created_at',
    ];

    public function replies(): HasMany
    {
        return $this->hasMany(ContactReply::class);
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(ContactLabel::class, 'contact_label')
            ->where('contact_label.user_id', auth()->user()->id);
    }

    public function history(): HasMany
    {
        return $this->hasMany(ContactHistory::class);
    }
}
