<?php

namespace App\Http\Requests\register;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveUser extends FormRequest
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
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'identification' => 'required|min:6',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'firstName.required' => 'Su nombre es requerido',
            'lastName.required' => 'Su apellido es requerido',
            'identification.required' => 'El documento es requerido',
            'identification.min' => 'El documento es debe tener al menos 6 caracteres',
            'email.required' => 'Su correo electrónico es requerido',
            'email.email' => 'El formato de su correo electrónico es inválido',
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
