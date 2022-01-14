<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Post extends FormRequest
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
            'code'      => 'required|unique:products,code',
            'name'      => 'required',
            'image'     => 'required',
            'image.*'   => 'mimes:jpg,jpeg,png',
            'price'     => 'required',
            'content'   => 'required',
            'inventory' => 'required',
            'discount'  => 'required',
            'category'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Ingrese nombre del producto',
            'code.required'         => 'Ingrese codigo del producto',
            'code.unique'           => 'El codigo ingresado pertenece a otro producto',
            'image.required'        => 'Seleccione una imagen',
            'image.*.mimes'         => 'El archivo no tiene formato de imagen ',
            'price.required'        => 'Ingrese el precio del producto',
            'content.required'      => 'Ingrese descripciòn del producto',
            'inventory.required'    => 'Ingrese stock del producto',
            'discount.required'     => 'Debe indicar si posee descuento el producto',
            'category.required'     => 'Debe indicar la categoria del producto'
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
