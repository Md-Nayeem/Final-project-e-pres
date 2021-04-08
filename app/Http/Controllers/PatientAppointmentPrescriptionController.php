<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\ProfilePhoto;
use App\Models\Doctor;
use Auth;
use Illuminate\Support\Arr; // To user array helper function
use Illuminate\Support\Str;
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
use App\Models\TestReport;
use PDF; 

use App\Notifications\PaymentNotify;



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
        
        



    }


    public function prescriptionsList($id){


        $patient = Patient::findOrFail($id);

        

        $oldprescriptionData = Prescription::select('*')
        ->where('patient_id','=',$patient->id)
        // ->orderBy('id','desc')
        ->latest()
        ->get();

        // dd($oldprescriptionData);

        //After prescription
        $patient->user->unreadNotifications->where('type','App\Notifications\PaymentNotify')->markAsRead();

        //After payment
        $patient->user->unreadNotifications->where('type','App\Notifications\PaymentDone')->markAsRead();

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
        
        //showing single prescription
        
        $appointment = Appointment::find($id);
        $singlePresdata = $appointment->checking->prescription;

        // dd($singlePresdata);

        return view('patient.singlePrescription',\compact('singlePresdata'));


    }


    public function CreatePDF($id){

        //all data from the db 
        // $appointment = Appointment::find($id);
        $singlePresdata = Prescription::findOrFail($id);

        // dd($singlePresdata);
        //share data to view 
        /* view()->share('singlePresdata',$singlePresdata);

            // below, first parameter is the view that will be converted, second is the value it will show.
        $pdf = PDF::loadView('patient.singlePrescription', ['singlePresdata'=> $singlePresdata]);

        //download pdf file with pdf view
        return $pdf->download('pdf_file.pdf'); */



        // Testing

        $user = User::findOrFail(1);

        $pdf = PDF::loadView('patient.presPDF',['singlePresdata'=>$singlePresdata]);
        return $pdf->download('presPDF.pdf');
        


    }







    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //Here Id = prescription id
        
        // return "THe id that will be updated is this...".$id;


        $prescription = Prescription::findOrFail($id);
        
        //Tarnary operator
        $prescription->private = $prescription->private == 1 ? 0 : 1;
        
        $prescription->update(['private'=>$prescription->private]);
        
        return \redirect()->back();

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
        //Test report post

        // dd($request);


        $data = $request->all();
        

        $test = MedicalTest::findOrFail($id);

        // dd($test);


        if($file = $request->file('photo_id')){
            
            $name =  Str::slug($test->test_name) ."-".Str::random(4).".". Str::after($file->getClientOriginalName(), '.');
            $file->move('img/test',$name); //This function will create a new folder in there is not any in public directory.
            $test_report = TestReport::create(['path'=>$name]);
            // $request->add(['test_report_file_id'=>$test_report->id]);
            // $request->test_report_file_id = $test_report->id;
            $data = $data + ['test_report_file_id' => $test_report->id];
            // dd($validated);
        }

        // dd($request);


        $test->update($data);

        return \redirect()->back();

        // update the test_report_it to the test 






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        TestReport::findOrFail($id)->delete();

        return \redirect()->back();




    }
}
