<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;


    protected $fillable = [
        'doctor_id',
        'patient_id',
        'dates',
        'time',
    ];



    /**
     * Get the doctor that owns the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


    /**
     * Get the checking associated with the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function checking()
    {
        return $this->hasOne(Checking::class);
    }


    /**
     * Get the patient that owns the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    



}
