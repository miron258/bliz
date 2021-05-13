<?php

namespace App\Http\Requests\API\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MenuItemsRequest extends FormRequest {

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
            'title' => 'required|max:100',
            'position' => 'required',
            'url' => 'required'
        ];
        return $rules;
    }

    public function wantsJson() {
        return true;
    }

    public function validate() {
        $instance = $this->getValidatorInstance();
        if ($instance->fails()) {
            return response()->json($instance->errors(), 200);
        }
    }

    public function messages() {
        return [
            'required' => 'Поля :attribute обязательно для заполнения',
            'unique' => 'Значение :attribute должны быть уникально',
            'url' => 'Поле должно содержать только латинские символы, подчеркивание и тире',
            'max' => 'Максмиальная длина поля :attribute :max символов',
            'alpha' => 'Поле :attribute должно содержать только латинские символы без цифр и знаков тире и подчеркивания'
        ];
    }

}
