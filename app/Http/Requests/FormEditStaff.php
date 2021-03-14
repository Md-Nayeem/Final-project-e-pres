<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormEditStaff extends FormRequest
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
            'name'=>'required|max:100|min:3',
            // 'email'=>'required|unique:users', //here, user is the table name
            'phone'=>'required|max:11|min:11',
            'shift_id'=>'required',
            'qualification'=>'required',
            'experience'=>'required',
        ];
    }
}
