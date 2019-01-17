<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                'import_file' => 'required|max:5000|extentions'
            ];
    }

    /**
     * Get the message rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'import_file.extentions' => 'The import file must be a file of type: csv, xlsx, xls, odt'
        ];
    }
}
