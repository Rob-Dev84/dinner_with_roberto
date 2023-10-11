<?php

namespace App\Http\Requests\Post\Recipe;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeoMetadataRequest extends FormRequest
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
            'cooking_method' => 'required|string',
            'prep_time_minutes' => 'nullable|integer|min:0',
            'cooking_time_minutes' => 'nullable|integer|min:0',
            'total_time_minutes' => 'nullable|integer|min:0',
            'yield' => 'nullable|integer|min:1|max:50',
        ];
    }
}
