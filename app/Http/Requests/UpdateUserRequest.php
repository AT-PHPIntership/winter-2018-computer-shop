<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => "required|email|unique:users,email,". $this->user->id,
            'name' => 'required|min:3',
            'address' => 'nullable|min:3',
            'phone' => 'nullable|numeric|digits:10',
            'avatar' => 'image|max:5000',
        ];
    }
}
