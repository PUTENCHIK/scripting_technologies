<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'post_id' => 'required',
            'user' => 'nullable',
            'text' => 'required|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'text.required' => 'Комментарий должен содержать текст',
            'text.min' => 'Комментарий должен быть не короче :min символов',
        ];
    }
}
