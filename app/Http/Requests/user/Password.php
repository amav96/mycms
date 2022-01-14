<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Password extends FormRequest
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
            'token_validate' => 'required|min:20',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'token_validate.required' => 'Token obligatorio',
            'token_validate.min' => 'El token es muy corto',
            'password.required' => 'Por favor escriba una contraseña',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'confirmPassword.required' => 'Por favor debe confirmar la contraseña',
            'confirmPassword.same' => 'Las contraseñas no coinciden',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
