<?php

namespace App\Http\Requests\Post\Comment;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            // 'post_id' => 'required|exists:posts,id',
            // 'user_id' => 'nullable|exists:users,id',
            // 'post_comment_status_id' => 'required|exists:post_comment_statuses,id',
            // 'user_ip' => 'nullable|ip',
            'rating' => 'nullable|integer|between:1,5',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => [
                'nullable',
                    Rule::requiredIf(function () {
                        return $this->input('rating') != 5;
                    }),
                'string',
            ],
            'cookies_consent' => 'boolean',
            'pinned' => 'boolean',
            'pinned_at' => 'nullable|date',
        ];
    }
}
