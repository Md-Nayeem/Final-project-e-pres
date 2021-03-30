<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // to user the table class

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $height = 170; // in cm
        // $weight = 55;  //in kg
        // $heightInMeters = 5.2/3.281;

        // $bmi = ($weight/($heightInMeters)^2)*10000;
        
        $height = 170; // in cm
        $weight = 55;  //in kg
        
        $bmi = ($weight/($height*$height))*10000;
        $bmi = \substr($bmi,0,4);



        DB::table('patients')->insert([
            
            [
                'user_id'=>6,
                'age'=>30,
                'gender_type_id'=> 1,
                'height'=> $height,
                'weight'=> $weight,
                'BMI'=> $bmi,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
            [
                'user_id'=>7,
                'age'=>35,
                'gender_type_id'=> 1,
                'height'=> $height+4,
                'weight'=> $weight+3,
                'BMI'=> $bmi,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
        ]);
    }
}
