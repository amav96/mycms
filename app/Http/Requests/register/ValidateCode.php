<?php

namespace App\Http\Requests\register;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidateCode extends FormRequest
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
            'code'                      => 'required',
            'token_validate'            => 'required',
            
        ];
    }

    public function messages()
    {
        return [
           'code.required'              => 'Debes ingresar el codigo',
           'token_validate.required'    => 'Falta el token',
        
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
