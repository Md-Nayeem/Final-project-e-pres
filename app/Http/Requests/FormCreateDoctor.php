<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCreateDoctor extends FormRequest
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
            'pres_code'=>'required|max:4|min:4',
            'password'=> 'required|min:8|confirmed',
            'department_id'=>'required',
            'med_bio'=>'required',
            'district_id'=>'required',
            'office_location'=>'required',
            'working_days'=>'required|min:7',
        ];
    }

    public function messages(){
        return[
            'name.min' => 'User name sould have more than 3 character',
            'working_days.min' => 'Please insert workingdays in the corrent format.'
        ];
    }



}
