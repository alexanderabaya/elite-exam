<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistingAccountRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value){
            $account = User::where('username', $value)->orWhere('email', $value)->first();
            if(!$account){
                $fail("The email or username is not registered.");
            }
        }
    }
}
