<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|min:2|unique:categories',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'image|max:5000'
        ];
    }

    /**
     * Return message alongside with validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'parent_id.exists' => 'The category not found in categories table.',
        ];
    }
}
