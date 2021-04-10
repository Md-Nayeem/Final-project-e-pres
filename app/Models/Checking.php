<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checking extends Model
{
    use HasFactory;

    // Tinker test data entry
    // $checking = App\Models\Checking::Create(['patient_id'=>1,'BP_up'=>110,'BP_down'=>90,'Heart_rate'=>70,'Breathing_status'=>'Normal'])

    protected $fillable = [
        'patient_id',
        'BP_up',
        'BP_down',
        'Heart_rate',
        'Breathing_status',
    ];


    /**
     * Get the prescription associated with the Checking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }


    /**
     * Get the appointment that owns the Checking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }


}
