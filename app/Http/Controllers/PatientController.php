<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Arr; // To user array helper function
use Illuminate\Support\Str;
use App\Models\Patient;
use App\Models\Checking;
use App\Models\ProfilePhoto;
use App\Models\Prescription;
use App\Models\Role;

class PatientController extends Controller
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
        


        // return view('guest.create');



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Guest should be here.
        // NEED FIXING -- Add a constructor - except method
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::user()->id) {
            // dd($user);
            
            return \view('patient.profile',\compact('user'));
        }
        return \redirect('404');
    }


    public function medicalTimeLine($id){


        $patient = Patient::findOrFail($id);

        

        $oldprescriptionData = Prescription::select('*')
        ->where('patient_id','=',$patient->id)
        ->get();





        return view('patient.myMedicalTimeLine',\compact('oldprescriptionData'));

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
        $user = User::findOrFail($id);
        // dd($user);

        if ($user->id === Auth::user()->id) {
            
            return \view('patient.profileEdit',\compact('user'));

        }
        return \redirect('404'); // User can not edit other users
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
        
        //Doc -> patient
        
        $user = User::findOrFail($id);
        $patient = Patient::where('user_id',$user->id)->first();

        //Password
        if (trim($request->password) == '') {  //Here using TRIM for not leting white spaces get HASHED 
            $input = $request->except('password'); //PASSWORD attribute will be excluded
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        //Profile picture
        if($file = $request->file('photo_id')){
            $name =  Str::slug($input['name']) ."-".Str::random(4).".". Str::after($file->getClientOriginalName(), '.');
            $file->move('img/profile',$name); 
            $pro_photo = ProfilePhoto::create(['path'=>$name]);
            //seting new photo id to the input photo_id column
            $input['photo_id'] = $pro_photo->id;
        }

        // dd($input);
        $user->update($input);
        $patient->update($input);

        // Session::flash('User_Updated','User date is updated');
        return \redirect('pt/'.$user->id);
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
