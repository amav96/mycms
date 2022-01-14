<?php

namespace App\Http\Requests\slider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveSlider extends FormRequest
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
            'name'          => 'required',
            'image'         => 'required|mimes:jpg,jpeg,png',
            'content'       => 'required',  
            'slider_order'  => 'required',
        ];
    }

    public function messages()
    {
        return [
           'name.required'      => 'Debe ingresar nombre del slider',
           'image.required'     => 'Debe seleccionar imagen',
           'image.mimes'        => 'La imagen es inválida',
           'content.required'   => 'Debe ingresar contenido del slider',
           'slider_order.required'       => 'Es necesario definir un orden de aparición'
    
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 404));
    }
}
