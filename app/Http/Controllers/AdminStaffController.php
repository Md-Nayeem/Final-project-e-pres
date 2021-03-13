<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Shift;
use App\Http\Controllers\Controller; //added extro for query builder
use Illuminate\Support\Facades\DB; // to user the table class

use Illuminate\Support\Facades\Auth;  // To access auth user data
use Illuminate\Support\Str; // To user string related function
use Illuminate\Support\Arr; // To user array helper function 
use App\Http\Requests\FormCreateDoctor; // To user the Custom request
use App\Models\User;
use App\Models\Role;
use App\Models\ProfilePhoto;
use App\Models\Doctor;
use App\Http\Requests\FormCreateStaff; // Data validation


class AdminStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::where('role_id','3')->get();
        return \view('admin.staff.index',\compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $shifts = Shift::pluck('name','id')->all();
        // dd($shifts);
        return \view('admin.staff.create', \compact('shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormCreateStaff $request)
    {

        $validated = $request->all();
        // dd($validated);
        
        $validated = Arr::add($validated,'role_id','3');

        $validated['password'] = \bcrypt($request->password);

        if($file = $request->file('photo_id')){
            
            $name =  Str::slug($validated['name']) ."-".Str::random(4).".". Str::after($file->getClientOriginalName(), '.');
            $file->move('img/profile',$name); //This function will create a new folder in there is not any in public directory.
            $pro_photo = ProfilePhoto::create(['path'=>$name]);
            $validated['photo_id'] = $pro_photo->id;
            // dd($validated);
        }
        // dd($validated);
        
        /* $Newstaff = User::Create($validated);
        $Newstaff->staff()->create($validated); */

        User::create($validated)->staff()->create($validated);

        return \redirect('admin-st');
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
