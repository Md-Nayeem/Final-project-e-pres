<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; //added extro for query builder
use Illuminate\Support\Facades\DB; // to user the table class

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // To access auth user data
use Illuminate\Support\Str; // To user string related function
use Illuminate\Support\Arr; // To user array helper function 
use App\Http\Requests\FormCreateDoctor; // To user the Custom request
use App\Models\User;
use App\Models\Role;
use App\Models\ProfilePhoto;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\District;

class AdminDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id','2')->get();
        // $doc = Doctor::all();
        $departments = Department::pluck('name','id')->all();
        $districts = District::pluck('name','id')->all();
        return \view('admin.doctor.index',\compact('users','departments','districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        $departments = Department::pluck('name','id')->all();
        $districts = District::pluck('name','id')->all();
        asort($departments);
        asort($districts);
        return \view('admin.doctor.create',\compact('roles','departments','districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormCreateDoctor $request)
    {
        // dd($request);
        //NEED validation 

        $validated = $request->all();
        
        
        // dd($validated);
        $validated = Arr::add($validated,'role_id','2');


        // $validated = Arr::add($validated,'extra','2');
        // dd($validated);

        $validated['password'] = \bcrypt($request->password);
        $validated['pres_code'] = \bcrypt($request->password);

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

        $Newuser = User::Create($validated);
        // Doctor::Create()

        // $data = [
        //     'user_id' => $Newuser->id,
        //     'department_id' => $request->department_id,
        //     'med_bio' => $request->med_bio,
        //     'experience' => $validated['experience'],
        //     'district_id' => $request->district_id,
        //     'office_location' => $request->office_location,
        //     'working_days' => $request->working_days,
        //     'visit_time' => $request->visit_time
        // ];

        // dd($data);
        // Doctor::create($data);


        // testing

        $Newuser->doctor()->create($validated);
        




        return \redirect('admin-dc');
    }



    public function assignedStaffToDoctorList(){

        $doctors = Doctor::all();
        

        //Doctor name,id
        $userDoc = User::where('role_id',2)
        ->join('doctors','doctors.user_id','users.id')
        ->select('users.name','doctors.id')
        ->get()
        ->pluck('name','id')->toArray();

        //Staff name, id 
        $userStaff = User::where('role_id',3)
        ->join('staff','staff.user_id','users.id')
        ->select('users.name','staff.id')
        ->get()
        ->pluck('name','id')->toArray();

        return view('admin.doctor_staff.listAssign',\compact('doctors','userDoc','userStaff'));

    }



    public function assignStaffToDoctor(Request $request){

        $appointments = DB::table('doctor_staff')
        ->insert([
            'doctor_id' => $request->doctor_id, 
            'staff_id' => $request->staff_id
        ]);

        return \redirect()->back();

    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show the assigned Staff to doctors






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
