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
                'experience'=>'1',
                'office_location'=>'Mirpur 1',
                'working_days'=>'Mon-Fri',
                'visit_time'=>'7pm-10pm',
                'department_id'=>1,
                'district_id'=>4,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
        ]);
    }
}
