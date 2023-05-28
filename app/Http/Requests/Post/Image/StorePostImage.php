<?php

namespace App\Http\Requests\Post\Image;

use Illuminate\Foundation\Http\FormRequest;

class StorePostImage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'path_*' => 'image|mimes:jpeg,png,jpg,gif|max:2048|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*\.[a-z]{3,4}$/', // add your validation rules for each image input field
            'path' => 'required_without_all:path_1,path_2,path_3,path_4,path_5', // validate if at least one image is uploaded
            'title_*' => 'max:125|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'alt_*' => 'max:125|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'figcaption_*' => 'max:200|regex:/^[\pL\s]+$/u',
        ];
    }
}
