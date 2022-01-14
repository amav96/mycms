<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Update extends FormRequest
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

            'name'      => 'required',
            'code'      => 'required',
            'price'     => 'required',
            'image.*'   => 'mimes:jpg,jpeg,png|max:10000|image',
            'content'   => 'required',
            'inventory' => 'required',
            'discount'  => 'required',
            'category'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Ingresa nombre del producto',
            'code.required'         => 'Ingrese codigo de producto',
            'price.required'        => 'Ingrese el precio del producto',
            'image.*.max'           => 'El archivo es muy grande',
            'image.*.image'         => 'El archivo no es una imagen',
            'image.*.mimes'         => 'El archivo no tiene formato de imagen ',
            'content.required'      => 'Ingrese descripciòn del producto',
            'inventory.required'    => 'Ingrese stock del producto',
            'discount.required'     => 'Debes indicar si el producto posee descuento',
            'category.required'     => 'Debes indicar la categoria del producto'
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
