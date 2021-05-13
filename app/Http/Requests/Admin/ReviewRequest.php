<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'name' => 'required|max:100',
            'text' => 'required',
            'text_order' => 'required|max:300',
            'address' => 'required|max:200'
        ];
        return $rules;
    }

    public function messages() {
        return [
            'integer' => 'Поля :attribute, должно содержать только цифры',
            'required' => 'Поля :attribute обязательно для заполенния',
            'unique' => 'Значение :attribute должны быть уникально',
            'max' => 'Максмиальная длина поля :attribute :max символов',
            'alpha' => 'Поле :attribute должно содержать только латинские символы без цифр и знаков тире и подчеркивания'
        ];
    }

}
