<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePhone extends FormRequest
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
           
            'token' => 'required|min:20',
            'phone' => 'required|min:10|max:10',
            
        ];
    }

    public function messages()
    {
        return [
            'token.required' => 'Token obligatorio',
            'token.min' => 'El token es muy corto',
            'phone.required' => 'Debe ingresar numero de teléfono',
            'phone.min' => 'El telefono debe tener 10 digitos',
            'phone.max' => 'El telefono debe tener 10 digitos',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
