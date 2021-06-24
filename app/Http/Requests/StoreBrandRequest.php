<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'brand_name.required' => 'A brand name is required',
            'brand_name.unique' => 'This brand name already exist',
            'brand_name.min' => 'Brand name is minimun 4Chars',
            'brand_image.required' => 'A brand image is required',
            'brand_image.mimes' => 'The brand image extension supported are jpg, png, jpeg'
        ];
    }
}
