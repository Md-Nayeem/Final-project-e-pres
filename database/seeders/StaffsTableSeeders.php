<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // to user the table class
use Carbon\Carbon;


class StaffsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            
            [
                'user_id'=>5,
                'shift_id'=>3,
                'qualification'=>'BIIT',
                'experience'=> 1,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            
        ]);
    }
}
