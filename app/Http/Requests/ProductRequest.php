<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        // dd($this->all());
        switch ($this->method()) {
            case "POST":
                $id = '';
                break;
            case "PUT":
                $id = $this->product->id;
                break;
        }
         return [
            'name' => 'required|min:3|unique:products,name,' . $id,
            'unit_price' => 'required|regex:/\d{1,3}(,\d{3})*$/',
            'quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'accessory_id.*' => 'exists:accessories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
         ];
    }

     /**
     * Return the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unit_price.regex' => 'The price input field must be number',
            'category_id.required' => 'The category field is required',
            'category_id.exists' => 'The category not found in category table',
            'accessory_id.*.exists' => 'The accessory not found in accessory table',
            'images.*.image' => 'One of the files you input is non-image file',
            'images.*.max' => 'One of the files you input has file size bigger than 5MB'
        ];
    }
}
