<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('shifts')->insert([

            ['name'=>'Morning','created_at'=>Carbon::now()->format('Y-m-d H:i:s'),'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['name'=>'Day','created_at'=>Carbon::now()->format('Y-m-d H:i:s'),'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['name'=>'Night','created_at'=>Carbon::now()->format('Y-m-d H:i:s'),'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')]

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
