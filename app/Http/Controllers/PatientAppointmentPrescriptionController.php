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
use App\Models\DoctorWorkingDay;
use App\Models\DoctorSchedule;
use App\Models\Prescription;
use App\Models\MedicalTest;
use App\Models\PatientMedicine;
use App\Models\Department;
use App\Models\District;
use App\Models\Appointment;

class PatientAppointmentPrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        //Patient -> Appointments -> view perticular prescription

        // dd(Auth::user()->id);

        
        $user = Auth::user();

        // $patient = Patient::where('user_id','=',6);

        // dd($user);

        // return view()



        // showing the booking
        // $patient = Patient::findOrFail($id);
        $appointments = Appointment::where('patient_id','=',$user->patient->id)
            ->orderBy('dates', 'desc')
            ->get();

        // dd($appointments);

        return view('patient.myAppointments',\compact('appointments'));










    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function prescriptionsList($id){


        $patient = Patient::findOrFail($id);

        

        $oldprescriptionData = Prescription::select('*')
        ->where('patient_id','=',$patient->id)
        ->get();

        // dd($oldprescriptionData);

        return view('patient.myPrescriptions',\compact('oldprescriptionData'));


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
