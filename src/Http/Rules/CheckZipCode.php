<?php

namespace Codificar\ZipCode\Http\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckZipCode implements Rule
{
    public $zipcode;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($zipcode)
    {
        $this->zipcode = $zipcode;
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
        if($this->zipcode != null && strlen($this->zipcode) > 1)
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The zipcode is not valid.';
    }
}