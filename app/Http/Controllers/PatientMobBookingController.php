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
        
        // show doctor schedules 

        
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
        //
    }
}
