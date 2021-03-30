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
use App\Models\MedicalTest;
use App\Models\PatientMedicine;
use App\Models\Appointment;
use App\Http\Requests\FromCreateCheckup;
use App\Http\Requests\FromCreatePrescription;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;



class DoctorPrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Patients will be used
        
    $users = User::where('role_id','4')->get();
        
        // Appointment -> patient -> user
        
        $todayNow = Carbon::now()->format('Y-m-d H:i:s');
        
        // $nextDay = $todayNow->addDays(1);
        
        // $todayNow = Carbon::now()->format('Y-m-d H:i:s');
        
        // dd($todayNow);
        
        $doctor_id = Auth::user()->doctor->id;
        
        // dd($doctor_id);
        
        
        // $appointments = Appointment::where('dates','>',Carbon::now()->format('d-m-Y H:i:s'))->get();
        
        
        
        // $users = User::has('patient.appointments')
        //     ->where('role')
        //     ->get();
        


        // this an upcomimg days, this doctor, and patients
        $users = DB::table('appointments')
            ->join('doctors','doctors.id','appointments.doctor_id')
            ->join('patients','patients.id','appointments.patient_id')
            ->join('users','users.id','patients.user_id')
            ->where('doctors.id','=',$doctor_id)
            ->where('dates','>',Carbon::now()->format('d-m-Y H:i:s'))
            ->get();



        

        // dd($users);
        // $appointments = Appointment::whereBetween('dates', [Carbon::now()->format('d-m-Y'), 100]);

        // $users = $appointments



        return \view('doctor.myappointedpatient',\compact('users'));

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
    public function checkstore(FromCreateCheckup $request)
    {
        // NEED FIXING

        $validated = $request->all();

        // $request->session()->put('patient_id', $request->patient_id);

        // if ($request->session()->has('patient_id')) {
        //     return true;
        // }

        // return $request->session()->all();

        $patient = Patient::findOrFail($validated['patient_id']);

        // dd($validated);
        // $patient->doctorchecking->create($validated);

        //test
        



        $checking = Checking::create($validated);

        $request->session()->put('checking_id', $checking->id);




        return \redirect()->back();

        // dd($patient);

        

        // return dd($request);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FromCreatePrescription $request)
    {

        // 3 table to add data  -> prescription | medical_test | patient_medicine
        // Quantity logic from the medicine table "maximum quantity" for preticular medicine
        
        // dd($request);

        $allData = $request->all(); //Array

        // dd($allData);
        // return $patient_id = $allData['patient_id'];
        $user = Auth::user();

        $validated = Arr::add($allData,'doctor_id',$user->doctor->id);

    //  return $checking_id = $request->session()->get('checking_id');




        $prescriptionData = [
            'patient_id'=> $allData['patient_id'],
            'doctor_id'=> $user->doctor->id,
            'disease'=> $allData['disease'],
            'symptoms'=> $allData['symptoms'],
            'procedure'=> $allData['procedure'],
            'end_date'=> $allData['end_date'],
            'next_visit'=>$allData['next_visit'],
        ];
        // dd($prescriptionData);


        $medicines = $allData['medicine'];

        // return count($medicines);

        $qtys = $allData['qty'];
        $days = $allData['days'];

        $tests = $allData['test'];
        // dd($tests);

        
        // $checking_id = $request->session()->get('checking_id');
        $checking_id = $request->session()->pull('checking_id');
        $checking = Checking::find($checking_id);
        // dd($checking);

        $checking->prescription()->create($prescriptionData);
        // $prescription = Prescription::create($prescriptionData);
        // $checking->Prescription->medicine->create($medicines);
        // $pres->medicine->create($medicines);


        // Patient_medicine data entry
        for ($i=0; $i < count($medicines); $i++) { 
            
            $patient_medicine = [
                'medicine_name'=>$medicines[$i],
                'quantity'=>$qtys[$i],
                'days'=>$days[$i],
            ];
            
            $checking->prescription->medicine()->create($patient_medicine);
        
        }

        // Patient Test data entry
        for ($i=0; $i < count($tests); $i++) { 
            
            $test_data = [
                'test_name'=>$tests[$i]
            ];

            $checking->Prescription->tests()->create($test_data);

        }

        return \redirect(route('dc-pres.index'));

    }





    public function findPatient(Request $request)
    {
        // dd($request);

        $userarray = User::where('email',$request->email)
                ->where('phone',$request->phone)
                ->get();
        $patient = $userarray[0];
        

        // $user = User::findOrFail(4);
        // dd($user);
        return \view('prescription.index', \compact('patient'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_arr = User::where('id',$id)->get();






        // NEED FIXING
    // $user_medicine_info = 
    // $user_test_info =

        $doctor = Doctor::where('user_id',Auth::user()->id)->get();
        // dd($doctor[0]);


        //THis is the user
        $patient = $user_arr[0];
        
        // return $patient->patient->id;

        // return $patient->id;

        // dd($user);


        // Checking to the prescription

        // $patientChecking = Checking::where('patient_id',$patient->id)->get();


        

        $oldprescriptionData = Prescription::select('*')
        ->where('patient_id','=',$patient->patient->id)
        ->where('doctor_id','=',$doctor[0]->id)
        ->get();

        

        // $medicines = $oldprescriptionData[0]->medicine[0]->medicine_name;

        // dd($medicines);

        // dd($oldprescriptionData);


        return \view('prescription.index',\compact('patient','oldprescriptionData'));

        // return view('')



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
