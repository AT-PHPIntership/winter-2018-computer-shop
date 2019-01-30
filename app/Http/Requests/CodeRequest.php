<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeRequest extends FormRequest
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
            'name' => 'required|min:3',
            'amount' => 'required|integer',
            'start_at' => 'required|date|after:yesterday',
            'end_at' => 'required|date|after:start_at',
            'order_month' => 'required_if:all_user,0|required_without_all:all_user',
            'all_user' => 'required|required_without_all:order_month'
        ];
    }
}
