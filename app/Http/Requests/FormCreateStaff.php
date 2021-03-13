<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCreateStaff extends FormRequest
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
            'email'=>'required|unique:users', //here, user is the table name
            'phone'=>'required|max:11|min:11',
            'password'=> 'required|min:6|max:20',
            'shift_id'=>'required',
            'qualification'=>'required',
            'experience'=>'required',
        ];
    }

    public function messages(){
        return[
            'name.min' => 'User name sould have more than 3 character',
            
        ];
    }


}
