<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest
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
            case 'POST':
            {
                return ['email' => "required|email|unique:users",
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
                'name' => 'required|min:3',
                'address' => 'required|min:3',
                'phone' => 'required|min:10|max:10',
                'avatar' => 'image|max:5000',
                ];
            }
            case 'PUT':
            {
                $id = $this->user->id;
                return [
                    'email' => "required|email|unique:users,email," . $id,
                    'name' => 'required|min:3',
                    'address' => 'required|min:3',
                    'phone' => 'required|min:10|max:10',
                    'avatar' => 'image|max:5000',
                    ];
            }
            default: break;
        }
    }
}
