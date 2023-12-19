<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'key', 'value'
    ];

    protected array $groups = [
        'mailing', 'contact', 'social', 'fiscal', 'other'
    ];

    public function groups(): array
    {
        return $this->groups;
    }
}
