<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // to user the table class
use Carbon\Carbon;

class ChronicConSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        DB::table('chronic_conditions')->insert([
            
            [
                'chro_name'=> 'Diabetes' ,
                'patient_id'=> 1,
                'chro_medicine' => 'Insulin',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'chro_name'=> 'Heart Disease' ,
                'patient_id'=> 2,
                'chro_medicine' => 'Lotensin',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
        ]);



    }
}
