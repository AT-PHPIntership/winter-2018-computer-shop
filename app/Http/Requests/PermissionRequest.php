<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
                $id = '';
                break;
            case 'PUT':
                $id = $this->permission->id;
                break;
            default:
                $id = '';
        }
        $rules = [
            'name' => 'required|min:3|max:255|unique:permissions,name,' . $id,
            'display_name' => 'required|min:3|max:255|unique:permissions,display_name,' . $id,
            'description' => 'nullable|min:3|string',
            'permission_action' => "required",
        ];
        if (!is_null($this->permission_action)) {
            $actions = count($this->permission_action);
            foreach(range(0, $actions - 1) as $index) {
                $rules['permission_action.' . $index] =  [Rule::in(config('constants.permission-actions'))];
            }
        }
        if (!is_null($this->name)) {
            $rules['name'] =  [Rule::in(config('constants.permissions'))];
        }

        return $rules;
    }

    /**
     * Return the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'permission_action.required' => 'The details field must check at least one input field',
            'permission_action.*.in' => 'One of the value of the checkboxs is invaild',
            'name.in' => 'Value of the name select box  is invaild',
        ];
    }
}
