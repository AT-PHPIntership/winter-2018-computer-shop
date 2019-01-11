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
         return $rules = [
            'name' => 'required|min:3|unique:products,name,' . $id,
            'unit_price' => 'required|regex:/\d{1,3}(,\d{3})*$/',
            'quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'accessory_id' => 'required|exists:categories,id'
        ];
        if (array_key_exists('images', $this->all())) {
            $images = count($this->images);
            foreach (range(0, $images) as $index) {
                $rules['images.' . $index] = 'image|max:5000';
            }
                return $rules;
        }  
        // if (array_key_exists('accessory_id', $this->all())) {
        //     $accessoryId = count($this->accessory_id);
        //     foreach (range(0, $accessoryId) as $index) {
        //         $rules['accessory_id.' . $index] = 'required|exists:accessories,id';
        //     }
        //         return $rules;
        // }  
        // dd(1);
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
            'images.*.image' => "One of the files you input is non-image file",
            'images.*.max' => "One of the files you input has file size bigger than 5MB"
        ];
    }
}
