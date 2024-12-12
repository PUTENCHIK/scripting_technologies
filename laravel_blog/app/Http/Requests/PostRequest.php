<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'text.required' => 'Текст поста не должен быть пустым'
        ];
    }
}
