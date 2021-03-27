<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\ProfilePhoto;
use App\Models\Doctor;
use Auth;
use Illuminate\Support\Arr; // To user array helper function
use App\Models\Patient;
use App\Models\Checking;
use App\Models\Prescription;
use App\Models\DoctorSchedule;
use App\Models\DoctorWorkingDay;


class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('doctor.addSchedule');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'dates'=>'required|date',
            'time'=>'required'
            ]);
        $validated = $request->all();


        $doctor = Auth::user()->doctor;
        // dd($doctor);


        $times = $validated['time'];
        $WorkingDaydata = [
            'doctor_id' => $doctor->id,
            'dates' => $validated['dates'],
        ];

        // dd($times);

        $createdworkingday =  $doctor->workingdays()->create($WorkingDaydata);


        foreach ($times as $time) {
            $timeData = [
                'doctor_working_day_id' => $createdworkingday->id,
                'time'=>$time,
                'is_available'=>true
            ];

            // hasMany through 
            $doctor->doc_schedules()->create($timeData);
            
            
            
        // THE CODE DID NOT WORK
                
                /* 
                here, 
                    $doctor->workingdays is a collection of models not a single model 
                    it is trying to call a collection so direct method can not be applied here. as this has 
                    "hasmany" relationship 
                
                */

                // $indexofcreated = $createdworkingday - 1;
                // dd($indexofcreated);
                // BELOW CODE DID NOT WORK
                    // $doctor->workingdays->get($createdworkingday)->schedules()->create($timeData);

        
        };


        return \redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
