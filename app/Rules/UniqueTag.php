<?php

namespace App\Rules;

use App\Models\PostTag;
use Illuminate\Contracts\Validation\Rule;

class UniqueTag implements Rule
{
    protected $post_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($post_id = NULL)
    {
        $this->post_id = $post_id;
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
        
        return !PostTag::where('post_id', $this->post_id)
                    ->where('tag_id', $value)
                    ->exists();

        // return PostTag::where('post_id', $this->post_id)
        //     ->where('tag_id', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The tags has already been inserted.';
    }
}
