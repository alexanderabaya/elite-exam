<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaskedNumberMaximumRule implements ValidationRule
{
    public $maximumNumber;
    public function __construct($maximumNumber) {
        $this->maximumNumber = $maximumNumber;
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
                if($number > $this->maximumNumber){
                    $fail('The :attribute field should not be greater than '.number_format($this->maximumNumber, 2, '.', ',').'.');
                }
            }
        }
    }
}
