<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!empty($value)){
            if(strlen($value) >= 8){
                if(strcmp ($value ,'regex:[^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$]'))
                 return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le mot de passe doit contenir au moins 8 caractères avec au moins une lettre MAJUSCULE et un munéro';
    }
}
