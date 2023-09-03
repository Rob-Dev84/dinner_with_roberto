<?php

namespace App\Http\Requests\Post;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRecipeRquest extends FormRequest
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

            // 'title' => ['required', //Ignore unique team name when user update name and Keep Unique team name per league 
            //             Rule::unique('posts', 'title')->ignore($this->post->id)
            //                     ->where('id', $this->post->id),    
            //             'max:100' //|regex:/^[\pL\s]+$/u'
            //             ],
            'title' => 'max:100',
            'meta_title' => 'max:100',
            'meta_description' => 'max:200',
            'intro' => 'string',
            'description' => 'string',
            'note' => 'string',
            // 'intro' => 'regex:/^[\pL\s\-]+$/u',
            // 'note' => 'regex:/^[\pL\s\-]+$/u',
        ];
    }
}
