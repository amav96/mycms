<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateGender extends FormRequest
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
            'gender' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'token.required' => 'Token obligatorio',
            'token.min' => 'El token es muy corto',
            'gender.required' => 'Debes ingresar el género',
    
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
