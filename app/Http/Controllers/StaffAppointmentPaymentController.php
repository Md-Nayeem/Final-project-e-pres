<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Arr; // To user array helper function
use App\Models\Patient;
use App\Models\Appointment;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;


class StaffAppointmentPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // the visited Patients.
        
        // all doctors appointments
        $appointments = DB::table('appointments')
            // ->join('doctors','doctors.id','appointments.doctor_id')
            ->join('patients','patients.id','appointments.patient_id')
            ->join('users','users.id','patients.user_id')
            // ->where('doctors.id','=',$doctor_id)
            ->where('dates','>=',Carbon::now())
            ->select('appointments.id')
            ->groupBy('appointments.id')
            ->orderBy('appointments.id', 'desc')
            ->get();

        $todayNow = Carbon::now()->format('Y-m-d H:i:s');

        return \view('staff.patientBookingList',\compact('appointments','todayNow'));

    }

    public function changeVisitedStatus($id){


        // dd($id);

        $appointment = Appointment::findOrFail($id);

        $appointment->visited = $appointment->visited == 0 ? 1 : 0;

        $appointment->update(['visited'=>$appointment->visited]);

        $appointment = Appointment::findOrFail($id);

        // dd($appointment);

        return \redirect()->back();


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
