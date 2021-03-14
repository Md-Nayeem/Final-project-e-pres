<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // to user the table class
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $samplePass = 45214521;
        $password = \bcrypt($samplePass);

        DB::table('users')->insert([
            
            [
                'name'=>'Md Nayeem',
                'email'=>'nayeem@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'1',
                'role_id'=>'1',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
            [
                'name'=>'Jimin',
                'email'=>'jimin@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'2',
                'role_id'=>'2',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name'=>'Fahad',
                'email'=>'fahad@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'3',
                'role_id'=>'3',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
        ]);
    }
}
