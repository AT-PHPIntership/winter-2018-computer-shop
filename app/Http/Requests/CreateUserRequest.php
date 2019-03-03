<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6|max:255',
            'name' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'phone' => 'required|size:10',
            'avatar' => 'image|max:5000',
            'role_id' => 'exists:roles,id',
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
            'role_id.exists' => 'The role not found in role table.',
        ];
    }
}
