<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidState implements Rule
{
    protected $validStates = ['published', 'unpublished'];
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, $this->validStates);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The state must be either "published" or "unpublished".';
    }
}
