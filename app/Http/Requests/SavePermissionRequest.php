<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Arr;

class SavePermissionRequest extends FormRequest
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
            //
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
        $validator->after(function ($validator) {
            $role = Role::all()->pluck('id')->toArray();
            foreach ($this->permissions as $permission) {
                if (count(array_intersect($permission['role'], $role)) < count($permission['role'])) {
                $validator->errors()->add('role', __('master.content.message.role', ['attribute' => $permission['id']]));
                }
            }
            });
        return;
    }
}
