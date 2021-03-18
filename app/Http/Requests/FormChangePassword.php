<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
class FormChangePassword extends FormRequest
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
            //NEED FIXING Custom validation 
            'old_password'=>'required',
            'password'=> 'required|min:6|max:20|confirmed',
        ];
    }

    // Custom
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator){
        // checks user current password
        // before making changes

        $validator->after(function($validator){
            if(!Hash::check($this->old_password, $this->user()->password)){
                $validator->errors()->add('old_password','Your old password is incorrect.');
            }
        });


    }


}
