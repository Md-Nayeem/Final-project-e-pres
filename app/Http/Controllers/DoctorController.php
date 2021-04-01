<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\District;
use App\Models\ProfilePhoto;
use Illuminate\Support\Str; // To user string related function
use Illuminate\Support\Arr; // To user array helper function 
use App\Http\Requests\FormEditDoctor;
use Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return \view('doctor.prescription');

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
        $user = User::findOrFail($id);
        if ($user->id === Auth::user()->id) {
            // dd($user);
            $departments = Department::pluck('name','id')->all();
            $districts = District::pluck('name','id')->all();
            return \view('doctor.profile',\compact('user','departments','districts'));
        }
        return \redirect('404'); // User can not edit other users

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // dd($user);

        if ($user->id === Auth::user()->id) {
            $departments = Department::pluck('name','id')->all();
            $districts = District::pluck('name','id')->all();
            return \view('doctor.edit',\compact('user','departments','districts'));
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
    public function update(FormEditDoctor $request, $id)
    {

        $user = User::findOrFail($id);
        $doctor = Doctor::where('user_id',$user->id)->first();

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
        $doctor->update($input);

        // Session::flash('User_Updated','User date is updated');
        return \redirect('dc/'.$user->id);
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
