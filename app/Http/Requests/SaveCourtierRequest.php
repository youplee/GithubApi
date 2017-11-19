<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCourtierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password'      => 'min:8|regex:[^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$]|required|confirmed',
            'prefixe'       => 'regex:[[A-Z]{3}]|required|unique:courtiers',
            'nom'           => 'required',
            'num_licence'   => 'required',
            'username'      => 'required',
            'dbname'        => 'required'
        ];
    }
}
