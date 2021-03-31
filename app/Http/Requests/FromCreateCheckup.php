<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FromCreateCheckup extends FormRequest
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
            'BP_up'=>'required|numeric|digits_between:2,3|between:110,180',
            'BP_down'=>'required|numeric|digits_between:2,3|between:70,120',
            'Heart_rate'=>'required|numeric|digits_between:2,3|between:60,100',
            'Breathing_status'=>'required|string',
            // 'appointment_id'=>'required',
        ];
    }
}
