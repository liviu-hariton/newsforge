<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Longitude implements ValidationRule
{
    /**
     * Match valid longitude values within the range of -180 to 179.999...
     * degrees for values less than 180, with optional decimals
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!preg_match("/^(-?((1[0-7][0-9])|([0-9]{1,2}))(.\d+)?)$|^(180(.0+)?)$/", $value)) {
            $fail('The '.$attribute.' must be a valid longitude.');
        }
    }
}
