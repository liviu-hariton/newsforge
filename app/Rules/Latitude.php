<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Latitude implements ValidationRule
{
    /**
     * Match valid latitude values within the range of -90 to 90 degrees, with optional decimals
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!preg_match("/^(-?[0-9]|[1-8][0-9]|90)(\.\d+)?$/", $value)) {
            $fail('The '.$attribute.' must be a valid latitude.');
        }
    }
}
