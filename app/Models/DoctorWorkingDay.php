<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorWorkingDay extends Model
{
    use HasFactory;


    protected $fillable = [
        'doctor_id',
        'dates'
    ];

    /**
     * Get the doctor that owns the DoctorWorkingDay
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


    /**
     * Get all of the schedules for the DoctorWorkingDay
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dc_schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_working_day_id');
    }


    



}
