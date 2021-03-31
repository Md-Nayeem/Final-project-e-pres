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
            
            [// id = 1
                'name'=>'Md Nayeem',
                'email'=>'nayeem@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'1',
                'role_id'=>'1',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
            [// id = 2
                'name'=>'Jimin',
                'email'=>'jimin@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'2',
                'role_id'=>'2',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],

            [// id = 3
                'name'=>'Doctor2',
                'email'=>'doctor2@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'2',
                'role_id'=>'2',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],

            [// id = 4
                'name'=>'Doctor3',
                'email'=>'doctor3@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'2',
                'role_id'=>'2',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],

            [// id = 5
                'name'=>'Fahad',
                'email'=>'fahad@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'3',
                'role_id'=>'3',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],

            [// id = 6
                'name'=>'Korim',
                'email'=>'korim@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'4',
                'role_id'=>'4',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],

            [// id = 7
                'name'=>'Lucy',
                'email'=>'lucy@gmail.com',
                'phone'=>'01784521451',
                'photo_id'=>'5',
                'role_id'=>'4',
                'password'=>$password,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
        ]);
    }
}
