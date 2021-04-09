<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'age',
        'gender',
        'blood_group',
        'allergies',
        'height',
        'weight',
        'BMI',
        
    ];

    /**
     * Get all of the doctorchecking for the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctorchecking()
    {
        return $this->hasMany(Checking::class);
    }



    /**
     * Get all of the appointments for the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }



    /**
     * Get the user that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the chronic_con associated with the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chronic_con()
    {
        return $this->hasOne(Chronic_condition::class);
    }


    /**
     * Get the genderType that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gender_type()
    {
        return $this->belongsTo(Gender_type::class);
    }




    /**
     * Get all of the prescriptions for the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }



}
