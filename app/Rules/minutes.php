<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class minutes implements Rule
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
        if($value!=15 && $value!=30 && $value!=45){
            return false;
        }
        return true;
        //Verifica si el valor esta entre 15, 30 o 45
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Los minutos deben ser 15, 30 o 45';
    }
}
