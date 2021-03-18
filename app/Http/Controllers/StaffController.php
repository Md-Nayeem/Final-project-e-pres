<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Shift;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // To user string related function
use Illuminate\Support\Arr; 
use App\Models\Role;
use App\Models\Staff;
use App\Models\ProfilePhoto;
use App\Http\Requests\FormEditStaff;
use Auth;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.appointment');
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
        // return "welcome staff profile";
        $user = User::findOrFail($id);
        if ($user->id === Auth::user()->id) {
            // dd($user);
            $shift = Shift::pluck('name','id')->all();
            return \view('staff.profile',\compact('user','shift'));
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
            return \view('staff.edit',\compact('user','shifts'));
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
        $staff = Staff::where('user_id',$user->id)->first();

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
        $staff->update($input);

        // Session::flash('User_Updated','User date is updated');
        return \redirect('st/'.$user->id);
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
