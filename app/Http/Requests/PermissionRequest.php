<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required|min:3|max:255|unique:permissions,name,' . $id,
            'display_name' => 'required|min:3|max:255|unique:permissions,display_name,' . $id,
            'description' => 'nullable|min:3|string'
        ];
        
    }
}
