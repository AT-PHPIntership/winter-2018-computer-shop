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
            'address' => 'required|min:3',
            'phone' => 'required|min:10|max:10',
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
