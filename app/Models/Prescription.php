<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    // tinker test
    //$perscription = App\Models\Prescription::create(['patient_id'=>1,'doctor_id'=>1,'checking_id'=>1,'note'=>'take medicine daily','start_date'=>'2021-03-16 11:40:42','end_date'=>'2021-03-30 11:40:42','next_visit'=>'2021-03-31 11:40:42'])

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'checking_id',
        'note',
        'start_date',
        'end_date',
        'next_visit',
    ];


}
