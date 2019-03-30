<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
            'name' => 'required|min:3|unique:promotions',
            'percent' => 'required|integer|between:1,100',
            'start_at' => 'required|date|after:yesterday',
            'end_at' => 'required|date|after:start_at',
            'total_sold' => 'required|integer|min:0|max:20',
            'category_id' => 'required|exists:categories,id',
            'price_product' => 'required|integer|min:5000000|max:30000000'
        ];
    }
}
