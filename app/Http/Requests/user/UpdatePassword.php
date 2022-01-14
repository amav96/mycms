<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class updatePassword extends FormRequest
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
            // 'token' => 'required|min:20',
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword',
        ];
    }

    public function messages()
    {
        return [
            // 'token.required' => 'Token obligatorio',
            // 'token.min' => 'El token es muy corto',
            'currentPassword.required' => 'Por favor escriba una contraseña',
            'currentPassword.min' => 'La contraseña debe tener al menos 6 caracteres',
            'newPassword.required' => 'Debe ingresar una nueva contraseña',
            'newPassword.min' => 'La contraseña debe tener al menos 6 caracteres',
            'confirmPassword.required' => 'Debe confirmar la contraseña',
            'confirmPassword.same' => 'Las contraseñas no coinciden',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
