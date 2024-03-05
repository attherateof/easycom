<?php

namespace App\Rules\Image;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Base64 implements ValidationRule
{
    private const PATTERN = '/^data:image\/(jpeg|jpg|png|webp);base64,([A-Za-z0-9+\/]+={0,2})$/i';

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match(self::PATTERN, $value)) {
            $fail('The :attribute is not in a correct base64 format.');
        }
    }
}
