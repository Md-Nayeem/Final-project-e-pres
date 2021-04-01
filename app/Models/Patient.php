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
        'gender_type_id',
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






}
