<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
{

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name' => 'required',
            'director_id' => 'required|integer',
            'year' => 'required|integer|between:1970,'.(date("Y")+3)
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Название дожно быть заполнено',
            'director_id.required' => 'Режиссёр должен быть выбран',
            'director_id.integer' => 'Выбирайте режиссера из списка',
            'year.required' => 'Введите год выхода',
            'year.between' => 'Между :min и :max годами',
        ];
    }

}
