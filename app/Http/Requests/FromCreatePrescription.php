<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FromCreatePrescription extends FormRequest
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
            'patient_id'=> 'required',
            'disease'=> 'required|string|min:3',
            'symptoms'=> 'required|string|min:3',
            'procedure'=> 'required|string|min:3',
            'end_date'=> 'required|date',
            'next_visit'=>'required|date',
        ];
    }

    public function messages(){
        return[
            'disease.min' => 'Disease information should be more than 3 characters long',
            'symptoms.min' => 'Symptoms information should be more than 3 characters long',
            'procedure.min' => 'Procedure information should be more than 3 characters long',
        ];
    }
}
