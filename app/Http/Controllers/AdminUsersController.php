<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // To access auth user data
use Illuminate\Support\Str; // To user string related function
use Illuminate\Support\Arr; // To user array helper function 
use App\Models\User;
use App\Models\Role;
use App\Models\ProfilePhoto;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\District;
use App\Models\Checking;
use App\Models\Appointment;
use App\Models\Shift;
use App\Models\Admin;
use App\Http\Requests\FromCreateAdmin;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::where('role_id','1')->get();

        $users = User::all();




        //Patients appointments.
        // $appointmentNumberTotal = Appointment::count();

        // dd($appointmentNumberTotal);


        // $shift = Shift::pluck('name','id')->all();
        return \view('admin.index',\compact('users'));
    }



    public function listadmin()
    {


        $users = User::where('role_id','1')->get();
        // $shift = Shift::pluck('name','id')->all();
        return \view('admin.listadmin',\compact('users'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shifts = Shift::pluck('name','id')->all();
        // dd($roles);
        return \view('admin.create',\compact('shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FromCreateAdmin $request)
    {
        // dd($request);
        //NEED validation 

        $validated = $request->all();
        
        
        // dd($validated);
        $validated = Arr::add($validated,'role_id','1');


        // $validated = Arr::add($validated,'extra','2');
        // dd($validated);

        $validated['password'] = \bcrypt($request->password);

        // $user = Auth::user();

        if($file = $request->file('photo_id')){
            // $name = Str::substr(time(), 3, 4) . $file->getClientOriginalName();
            //Photo Name
            $name =  Str::slug($validated['name']) ."-".Str::random(4).".". Str::after($file->getClientOriginalName(), '.');
            // return $name;
            $file->move('img/profile',$name); //This function will create a new folder in there is not any in public directory.
            $pro_photo = ProfilePhoto::create(['path'=>$name]);
            $validated['photo_id'] = $pro_photo->id;
        }

        // $Newuser = User::Create($validated);
        // Doctor::Create()
        User::create($validated)->admin()->create($validated);
        
        return \redirect('admin-ad');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return \view('admin.doctor.show');
        $user = User::findOrFail($id);
        if ($user->id === Auth::user()->id) {
            // dd($user);
            $shift = Shift::pluck('name','id')->all();
            return \view('admin.profile',\compact('user','shift'));
        }
        return \redirect('404'); // User can not see other profile

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
        if ($user->id === Auth::user()->id) {
            // dd($user);
            $shifts = Shift::pluck('name','id')->all();
            return \view('admin.edit',\compact('user','shifts'));
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
        $user = User::findOrFail($id);
        $admin = Admin::where('user_id',$user->id)->first();

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
        $admin->update($input);

        // Session::flash('User_Updated','User date is updated');
        return \redirect('admin-ad/'.$user->id);
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


    // Extra methods

    
    
    
    




}
