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
            'category_id' => 'exists:categories,id'
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
            'category_id.exists' => 'The category not found in category table',
        ];
    }
}
