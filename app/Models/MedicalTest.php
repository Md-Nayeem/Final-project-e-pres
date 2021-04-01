<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_name',
        'prescription_id',
        'test_report_file_id',
    ];

    /**
     * Get the testreport associated with the MedicalTest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function testReport()
    {
        return $this->belongsTo(TestReport::class, 'test_report_file_id');
    }


    



}
