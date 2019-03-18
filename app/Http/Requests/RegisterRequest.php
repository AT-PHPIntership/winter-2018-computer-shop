<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|min:6|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'exists:roles,id,name,'.\App\Models\Role::ROLE_NORMAL,
            'is_actived' => 'in:0'
        ];
    }

    /**
     * Return message base on rule
     *
     * @return array
     */
    public function messages()
    {
        return [
            'role_id.exists' => 'You can not change the role field',
            'is_actived.in' => 'You can not change the actived field',
        ];
    }
}
