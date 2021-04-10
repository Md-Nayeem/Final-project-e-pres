<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'med_bio',
        'experience',
        'pres_code',
        'district_id',
        'office_location',
        'working_days',
        'visit_time',
        'visit_fees'
    ];

    /**
     * Get the user that owns the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the department that owns the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    /**
     * Get the district that owns the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }



    /**
     * Get all of the workingdays   for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workingdays()
    {
        return $this->hasMany(DoctorWorkingDay::class);
    }


    /**
     * Get all of the doc_schedules for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function doc_schedules()
    {
        return $this->hasManyThrough(
            DoctorSchedule::class, 
            DoctorWorkingDay::class,
            'doctor_id',
            'doctor_working_day_id'
        );
    }



    /**
     * Get all of the appointments for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }



    /**
     * Get all of the staffs for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staffs()
    {
        return $this->belongsToMany(Staff::class);
    }


    /**
     * Get all of the prescriptions for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }





}
