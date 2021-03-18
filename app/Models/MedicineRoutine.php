<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineRoutine extends Model
{
    use HasFactory;

    //tinker test
    // $medicine_routine::create(['prescription_id'=>,'patient_medicine_id'=>1,'morning'=>1,'day'=>1,'night'=>0])
    protected $fillable = [
        'prescription_id',
        'patient_medicine_id',
        'morning',
        'day',
        'night',
    ];
}
