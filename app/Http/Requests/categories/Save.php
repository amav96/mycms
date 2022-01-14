<?php

namespace App\Http\Requests\categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Save extends FormRequest
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
     * @return array
     */

    public function rules()
    {
        return [
            'module' => 'required',
            'name' => 'required',
            'icon' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'module.required' => 'Debe ingresar el modulo',
            'name.required' => 'Debe ingresar nombre para al categoria',
            'icon.required' => 'Debe ingresar icono para la categoria',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 200));
    }
}
