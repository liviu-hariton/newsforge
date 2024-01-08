<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
