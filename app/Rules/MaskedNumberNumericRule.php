<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaskedNumberNumericRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value){
            if(!preg_match('/^[0-9.,]+$/', $value)){
                $fail('The :attribute field should be numeric.');
            }
        }
    }
}
