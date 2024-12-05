<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DirectorRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|min:5'
        ];
    }

    public function messages(): array {
        return [
            'full_name.required' => 'Введите полное имя',
            'full_name.min' => 'Полное имя должно быть не короче :min символов',
        ];
    }
}
