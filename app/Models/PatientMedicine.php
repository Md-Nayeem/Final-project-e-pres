<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicine extends Model
{
    use HasFactory;

    // tinker test
    // $patientMedicine = App\Models\PatientMedicine::create(['prescription_id'=>1,'medicine_name'=>'Napa extra','quantity'=>3,'days'=>2])
    protected $fillable = [
        'prescription_id',
        'medicine_name',
        'quantity',
        'days',
    ];


}
