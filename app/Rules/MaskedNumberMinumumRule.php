<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaskedNumberMinumumRule implements ValidationRule
{
    public $minimumNumber;
    public function __construct($minimumNumber) {
        $this->minimumNumber = $minimumNumber;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value){
            if(preg_match('/^[0-9.,]+$/', $value)){
                $number = str_replace(',' , '',$value);
                if($number < $this->minimumNumber){
                    $fail('The :attribute field should not be less than '.number_format($this->minimumNumber, 2, '.', ',').'.');
                }

            }
        }
    }
}
