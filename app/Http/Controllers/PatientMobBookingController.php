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


use App\Notifications\AppointmentNotify;
use App\Notifications\BookingNotifyStaff;


use App\Models\Staff;


class PatientMobBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $departments = Department::pluck('name','id')->all();
        $districts = District::pluck('name','id')->all();

        // dd($districts);

        return view('patient.findDoctor',\compact('departments','districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('patient.confirmAppointment');


    }


    public function makeAppointment(Request $request)
    {
        // dd($request);
        $doctor =  Doctor::findOrFail($request->doctor_id);
        $time = $request->time;
        $date = $request->dates;


    // test
        // appoint will not be possible in the same day 
        $user =  Auth::user();


        // dd($user->patient->id);

        $oldAppointment = Appointment::where([
            ['doctor_id','=',$doctor->id],
            ['patient_id','=',$user->patient->id],
            ['dates','=',$date]
        ])->get();

        // dd($oldAppointment[0]->id);

        // dd($doctor);
        return view('patient.confirmAppointment',\compact('doctor','time','date','oldAppointment'));

    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $user = Auth::user();

        $patient =  $user->patient;

        // dd($patient->id);
        
        // adding to the request - This is not a standard approach
            // $request->request->add(['varible'=>'value']);

        // Union Array 
        $appointment = Appointment::create($request->all() + ['patient_id' => $patient->id]);

        $user->notify(new AppointmentNotify);
        

        // echo "Yo";
        $staffUser = $appointment->doctor->staffs->first()->user;
        
        // dd($staffUser_id);
        // $staffUser = Staff::findOrFail($staffUser_id);
        //Booking
        $staffUser->notify(new BookingNotifyStaff($appointment,$user));
        // dd($staffUser);



        return \redirect('patient/'.$request->doctor_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $doctor = Doctor::findOrFail($id);
        
        //testing
            // $workingdays = DoctorWorkingDay::where('doctor_  id',$id);
            // $workingdays = $doctor->workingdays;
            // dd($workingdays[1]->dates);
            // $schedules_Arrays = $doctor->doc_schedules;
        //t

        //This code is used for the schedule display in view
            // for ($i=0; $i < $doctor->workingdays->count() ; $i++) { 
                
            //     echo "<br>";
            //     $perticulardaytimes =  $doctor->workingdays->get($i)->dc_schedules;
        
            //     $x = 0;
        
            //     foreach ($perticulardaytimes as $perticulardaytime ) {
                    
            //         echo $perticulardaytime->time . " ";
        
        
            //     }
            // }




       
        // return $x;

        // testdata()
            // dd($perticularday);
            // dd($perticularday[0]->time);
            // dd($doctor->user->profilePhoto->path);
        //dd

        return view('patient.availableDoctorDates',\compact('doctor'));

    }

// patient views appointment start
    public function viewMyAppointments($id){

        $patient = Patient::findOrFail($id);
        $appointments = Appointment::where('patient_id','=',$patient->id)
            ->orderBy('dates', 'desc')
            ->get();

        // dd($appointments);


        // foreach ($patient->user->unreadNotifications as $notification) {
        //     $notification->markAsRead();
        // }
        
        //THis will loop through all this type of notification and mark it
        $patient->user->unreadNotifications->where('type','App\Notifications\AppointmentNotify')->markAsRead();
        
        $patient->user->unreadNotifications->where('type','App\Notifications\PaymentDone')->markAsRead();
        


        return view('patient.myAppointments',\compact('appointments'));

    }

// end

    
    




    public function search(Request $request){

        //get the value from the request 
        $search = $request->all();

        // return $request->filled('name');

        // when name input is given
        if ($request->filled('name')) {

            $userdoc = User::where('name','LIKE',"%{$search['name']}%")
                ->where('role_id',2)->get();

            $user_id = $userdoc[0]->id;

            $doctors = Doctor::where('user_id',$user_id)->get();

            return view('patient.searchedDoctors',\compact('doctors'));

        }else {
            //when name input is not given
            $doctors = Doctor::where('district_id','=',$search['district_id'])
                ->where('department_id','=',$search['department_id'])
                ->orWhere('district_id','=',$search['district_id'])
                ->orWhere('department_id','=',$search['department_id'])
                ->get();

            return view('patient.searchedDoctors',\compact('doctors'));
            
        }




        // $request->whenFilled('name',function($query){
        //     $doctors = User::Where('name','like',"%{$search['name']}%")
        //     ->where('role_id','2')->get();
        // });
        

        // return $doctors;




        // dd($search);

        // $doctors = Doctor::where('district_id','=',$search['district_id'])
        //                     ->where('department_id','=',$search['department_id'])
        //                     ->get();
        
        // dd($doctors); //THis will be a doctors array.




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


        // dd($id);

        $appointment = Appointment::findOrFail($id);
        $doctor_id = $appointment->doctor_id;

        $appointment->delete();

        // return \redirect()->back();
        return \redirect('patient/'.$doctor_id);
    }
}
