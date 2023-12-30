<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArraySize implements Rule
{
    protected $size;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function passes($attribute, $value)
    {
        return is_array($value) && count($value) === $this->size;
    }

    public function message()
    {
        return "The :attribute must contain $this->size items.";
    }
}
