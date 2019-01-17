<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class ImportRequest extends FormRequest
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
            'extentions' => strtolower($this->import_file->getClientOriginalExtension())
        ];
        [
            'import_file' => 'required|file|max:10000',
            'extentions' => 'required|in:csv,xlsx,xls,odt'
        ];
    }
}
