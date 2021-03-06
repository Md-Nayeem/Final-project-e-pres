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

use App\Notifications\PaymentNotify;
use App\Notifications\PatientWatingNotifyDoc;

use Illuminate\Support\Facades\Hash;


class DoctorPrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $todayNow = Carbon::now()->format('Y-m-d H:i:s');
        
        // $nextDay = $todayNow->addDays(1);
        
        // $todayNow = Carbon::now()->format('Y-m-d H:i:s');
        
        // dd($todayNow);
        $doctorUser = Auth::user();
        
        $doctor_id = $doctorUser->doctor->id;
        
        // dd($doctor_id);
        
        
        // $appointments = Appointment::where('dates','>',Carbon::now()->format('d-m-Y H:i:s'))->get();
        
        
        
        // $users = User::has('patient.appointments')
        //     ->where('role')
        //     ->get();
               

        // get only id -> query again in the view.
        $appointments = DB::table('appointments')
            ->join('doctors','doctors.id','appointments.doctor_id')
            ->join('patients','patients.id','appointments.patient_id')
            ->join('users','users.id','patients.user_id')
            ->where('doctors.id','=',$doctor_id)
            ->where('dates','>=',Carbon::now())
            ->where('appointments.visited',1)
            ->select('appointments.id')
            ->groupBy('appointments.id')
            ->orderBy('appointments.id', 'desc')
            ->get();

        //doc
        // $user = User::findOrFail(2);

        // $patientx = User::find(6);

        // dd($users);
        // $res =  $user->doctor->appointments;
        
    // For find the appointment id

        // $res =  $user->doctor->appointments->where('patient_id','=',$patientx->patient->id)->where('dates','>',$todayNow)->first();
        
        // $res =  $user->doctor->appointments->where('patient_id','=',$patientx->patient->id)->where('dates','>',$todayNow)->first();

        // $apt = Appointment::where('patient_id','=',$patientx->patient->id)->where('dates','>',$todayNow)->first();



        // dd($apt);
        // $appointments = Appointment::whereBetween('dates', [Carbon::now()->format('d-m-Y'), 100]);

        // $users = $appointments


        $doctorUser->unreadNotifications->where('type','App\Notifications\PatientWatingNotifyDoc')->markAsRead();



        return \view('doctor.myappointedpatient',\compact('appointments','todayNow'));

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


        $validated = $request->all();
        $pt = Patient::findOrFail($validated['patient_id']);
        $patient = User::findOrFail($pt->user_id);
        $appointment_id = $validated['appointment_id'];
        $appointment = Appointment::findOrFail($appointment_id);
        $checking = $appointment->checking()->create($validated);

        $request->session()->put('checking_id', $checking->id);

        $doctor = Doctor::where('user_id',Auth::user()->id)->get();

        $oldprescriptionData = Prescription::select('*')
        ->where('patient_id','=',$patient->patient->id)
        ->where('doctor_id','=',$doctor[0]->id)
        ->get();
        return \view('prescription.index',\compact('patient','oldprescriptionData','appointment_id','checking'));


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
        
        $allData = $request->all(); //Array
        $user = Auth::user();

        $validated = Arr::add($allData,'doctor_id',$user->doctor->id);

        if (Hash::check($allData['digital_signature'], $user->doctor->pres_code)) {
            //if the digital signature matches doc pres_code.

            $prescriptionData = [
                'patient_id'=> $allData['patient_id'],
                'doctor_id'=> $user->doctor->id,
                'disease'=> $allData['disease'],
                'symptoms'=> $allData['symptoms'],
                'procedure'=> $allData['procedure'],
                'end_date'=> $allData['end_date'],
                'next_visit'=>$allData['next_visit'],
                'digital_signature'=>$user->doctor->pres_code,
            ];
            $medicines = $allData['medicine'];

            $qtys = $allData['qty'];
            $days = $allData['days'];

            if (Arr::has($allData,'test')) {
                $tests = $allData['test'];
            }
            $checking_id = $request->session()->pull('checking_id');
            $checking = Checking::find($checking_id);

            $checking->prescription()->create($prescriptionData);
            for ($i=0; $i < count($medicines); $i++) { 
                
                $patient_medicine = [
                    'medicine_name'=>$medicines[$i],
                    'quantity'=>$qtys[$i],
                    'days'=>$days[$i],
                ];
                
                $checking->prescription->medicine()->create($patient_medicine);
            
            }

            // Patient Test data entry

            if (Arr::has($allData,'test')) {
                if ($tests[0] != null) {
                    for ($i=0; $i < count($tests); $i++) { 
                        $test_data = [
                            'test_name'=>$tests[$i]
                        ];
                        $checking->Prescription->tests()->create($test_data);
                    }
                }
            } 
            
            // For notification
            $patient = Patient::findOrFail($allData['patient_id']);
            $patient->user->notify(new PaymentNotify);
            

            return \redirect(route('dc-pres.index'));


        } else { // iF the pres_code doesnot match
            
            $patient = Patient::findOrFail($allData['patient_id'])->user;

            $checking_id = $request->session()->get('checking_id');
            $checking = Checking::findOrFail($checking_id);

            $appointment_id = $checking->appointment->id;


            $request->session()->flash('Comment_message','Your Code does not match!');
            $oldprescriptionData = Prescription::select('*')
            ->where('patient_id','=',$patient->id)
            ->where('doctor_id','=',Auth::user()->doctor->id)
            ->get();

            return \view('prescription.index',\compact('patient','oldprescriptionData','appointment_id','checking'));


        }
        


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
        
        // $appointment = Appointment::find($id);
        // $singlePresdata = $appointment->checking->prescription;


        $singlePresdata = Prescription::findOrFail($id);



        // dd($singlePresdata);

        // return view('patient.singlePrescription',\compact('singlePresdata'));
        return view('prescription.singleAppointmentPrescription',\compact('singlePresdata'));



    }


    public function ShowPrescriptionSystem(Request $request){
        
        $user_arr = User::where('id',$request->patient_user_id)->get();

        $appointment_id = $request->appointment_id;

        $doctor = Doctor::where('user_id',Auth::user()->id)->get();
        $patient = $user_arr[0];
        

        //Prescription from all doctor when public
        $oldprescriptionData = Prescription::select('*')
        ->where('patient_id','=',$patient->patient->id)
        ->where('private',0)
        ->orWhere('patient_id','=',$patient->patient->id)
        ->where('doctor_id','=',$doctor[0]->id)
        ->get();

        return \view('prescription.index',\compact('patient','oldprescriptionData','appointment_id'));

    }


    public function showAllPrecribedPrescriptions(){

        // Here, all the old prescription will be shown.

        // $user = Auth::user();

        


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
        //Here the doctor can update the fees of the visit

        $doctor_id = $id;
        // dd($request);
        $doctor = Doctor::findOrFail($doctor_id);
        // dd($doctor);
        $doctor->update(['visit_fees'=>$request->visit_fees]);

        return \redirect()->back();





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
