<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilterUsers extends FormRequest
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

    protected function prepareForValidation()
    {
          
        $this->merge([
            'filter' => isset(json_decode($this->get('dataRequest'), true)["filter"]) ? json_decode($this->get('dataRequest'), true)["filter"] : '',
            'status' => isset(json_decode($this->get('dataRequest'), true)["status"]) ? json_decode($this->get('dataRequest'), true)["status"] : false
        ]);

        // 'filter' => json_decode($this->get('dataRequest'),true)["filter"] ? 

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

   

    public function rules()
    {

     
        return [
            'filter' => 'required',
        ];
    }

    public function messages()
    {
      
        
        return [
            'filter.required' => 'Debes ingresar una busqueda',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
