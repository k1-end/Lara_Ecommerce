<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Image;
class Image1000 implements Rule
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
        $image = Image::make($value);
        if ($image->height() >= 1000 && $image->width() >= 1000) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The image size must be smaller than 1000*1000 Pixels.';
    }
}
