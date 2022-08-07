<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EstateRequest extends FormRequest
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
            'name'=>'required',
            'description'=>'required',
            'roomnumber'=>'required',
            'state'=>'required',
            'price'=>'required',
            'local'=>'required',
            'lan'=>'required',
            'lat'=>'required',
            'photo'=>'required|image',
            'bathroomnumber'=>'required',
            'bedroomnumber'=>'required',
           'propartytype'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'msg'=> $validator->errors(),
        ]));
    }
}
