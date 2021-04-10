<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // to user the table class
use Carbon\Carbon;


class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            
            [
                'user_id'=>2,
                'med_bio'=>'DMC MBBS',
                'experience'=>'3',
                'office_location'=>'Mirpur 1',
                'working_days'=>'Mon-Fri',
                'visit_time'=>'7pm-10pm',
                'pres_code'=> bcrypt('1234'),
                'department_id'=>1,
                'district_id'=>1,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id'=>3,
                'med_bio'=>'Sir Salimullah Medical College',
                'experience'=>'5',
                'office_location'=>'Nasirabad',
                'working_days'=>'Mon-Fri',
                'visit_time'=>'7pm-10pm',
                'pres_code'=> bcrypt('1234'),
                'department_id'=>2,
                'district_id'=>7,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id'=>4,
                'med_bio'=>'Mymensingh Medical College',
                'experience'=>'3',
                'office_location'=>'CK Ghos Road',
                'working_days'=>'Mon-Fri',
                'visit_time'=>'7pm-10pm',
                'pres_code'=> bcrypt('1234'),
                'department_id'=>3,
                'district_id'=>3,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
        ]);
    }
}
