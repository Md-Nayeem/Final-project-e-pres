<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\FormChangePassword;
use Auth;

class UserCommonController extends Controller
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
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Pasword change view 
        $user = User::findOrFail($id);

        if ($user->id === Auth::user()->id) {

            return view('changePassword',\compact('user'));

        }
        return \redirect('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormChangePassword $request, $id)
    {
        // dd($request);

        $newPassword = \bcrypt($request->password);
        $password = [
            'password'=>$newPassword
        ];
        $user = Auth::user();
        $user->update($password);

        //Role based redirect
        switch ($user->role->name) {
            
            case 'Admin':
                return \redirect('admin-ad/'.$user->id);
                break;

            case 'Doctor':
                return \redirect('dc/'.$user->id);
                break;

            case 'Staff':
                return \redirect('st/'.$user->id);
                break;
            
            default:
                return \redirect('home/');
                break;
                
        }


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
