<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStatusRequest extends FormRequest
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
            'status' => 'required|min:0|max:4|integer'
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
            'status.exists' => 'The status not found in orders table.',
        ];
    }
}
