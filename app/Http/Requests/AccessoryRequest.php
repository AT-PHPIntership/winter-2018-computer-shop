<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccessoryRequest extends FormRequest
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
                $id = $this->accessory;
                break;
        }
        return [
            'name' => 'required|min:3|max:255|unique:accessories,name,' . $id,
            'parent_id' => 'nullable|exists:accessories,id',
        ];
    }

    /**
     * Return the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'parent_id.exists' => 'The accessory not found in accessories table',
        ];
    }
}
