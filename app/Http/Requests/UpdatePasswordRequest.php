<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class UpdatePasswordRequest extends FormRequest
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
            'password' => 'required|confirmed|min:6'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator validator
     *
     * @return void
     */
    public function withValidator($validator)
    {
        if ($this->user->password != "") {
            $validator->after(function ($validator) {
                if (is_null($this->current_password) || !Hash::check($this->current_password, $this->user->password)) {
                    $validator->errors()->add('current_password', __('public.profile.wrongPassword'));
                }
            });
        }
        return;
    }
}
