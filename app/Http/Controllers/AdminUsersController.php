<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // To access auth user data
use Illuminate\Support\Str; // To user string related function
use Illuminate\Support\Arr; // To user array helper function 
use App\Models\User;
use App\Models\Role;
use App\Models\ProfilePhoto;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id','2')->get();
        return \view('admin.doctor.index',\compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        // dd($roles);
        return \view('admin.doctor.create',\compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        //NEED validation 

        $validated = $request->all();
        
        
        // dd($validated);
        $validated = Arr::add($validated,'role_id','2');
        // dd($validated);

        $validated['password'] = \bcrypt($request->password);

        $user = Auth::user();

        if($file = $request->file('photo_id')){
            // $name = Str::substr(time(), 3, 4) . $file->getClientOriginalName();
            //Photo Name
            $name =  Str::slug($validated['name']) ."-".Str::random(4).".". Str::after($file->getClientOriginalName(), '.');
            // return $name;
            $file->move('img/profile',$name); //This function will create a new folder in there is not any in public directory.
            $pro_photo = ProfilePhoto::create(['path'=>$name]);
            $validated['photo_id'] = $pro_photo->id;
        }

        User::Create($validated);

        return \redirect('admin-dc');



        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \view('admin.doctor.show');
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
