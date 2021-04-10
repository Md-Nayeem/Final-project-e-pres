<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr; // To user array helper function 

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>['required','max:11','min:11'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age' => ['required','numeric','digits_between:1,3'],
            'gender' => ['required'],
            'blood_group' => ['required'],
            'height' => ['required','numeric','digits_between:2,3'],
            'weight' => ['required','numeric','digits_between:2,3'],
            // 'allergies' => ['string'],
        ]);


        


    }
    


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        // dd($data);

        


        $height = $data['height']; // in cm
        $weight = $data['weight'];  //in kg
        
        $bmi = ($weight/($height*$height))*10000;
        $BMI = \substr($bmi,0,4);

        $data = Arr::add($data,'role_id','4');
        $data = Arr::add($data,'BMI',$BMI);

        // dd($data['blood_group']);


        $Newuser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            // 'age' => $data['age'],
            // 'gender' => $data['gender'],
            // 'blood_group' => $data['blood_group'],
            // 'height' => $data['height'],
            // 'weight' => $data['weight'],
        ]);


        $Newuser->patient()->create($data)->chronic_con()->create($data);
        

        return $Newuser;

        // return view('auth.login');














    }
}
