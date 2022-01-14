<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUser extends FormRequest
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
           
            'id'            => 'required',
            'id_admin'      => 'required',
            'status'        => 'required',
            'role'          => 'required',
            'motive'        => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'No hemos recibido el usuario a modificar',
            'id_admin.required' => 'No ha sido posible reconocer el administrador',
            'status.required' => 'Debes ingresar el estado',
            'role.required' => 'Debes ingresar el rol',
            'motive.required' => 'Debes ingresar el motivo de este cambio',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
