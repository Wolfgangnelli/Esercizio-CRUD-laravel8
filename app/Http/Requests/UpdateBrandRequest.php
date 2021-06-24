<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'brand_name' => 'required|min:4',
            'brand_image' => 'mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'brand_name.required' => 'A brand name is required',
            'brand_name.min' => 'Brand name is minimun 4Chars',
            'brand_image.mimes' => 'The brand image extension supported are jpg, png, jpeg'
        ];
    }
}
