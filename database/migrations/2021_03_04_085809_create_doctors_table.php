<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            
            $table->id();
            
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('department_id');
            $table->text('med_bio');
            $table->integer('experience');
            // $table->unsignedBigInteger('district_id');
            $table->string('office_location');
            $table->string('working_days');
            $table->string('visit_time');
            $table->integer('visit_fees')->default(500);
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('district_id')->constrained('districts');
            /**
             * This part is necessary for us to use the soft-delete feature.
             */
            $table->softDeletes();
            // Constraints
            // $table->foreign('user_id')->references('id')->on('users');
            
        });

        // DB::table('doctors')->insert([
        //     ['med_bio'=>'DMC MBBS'],
        //     ['experience'=>'1'],
        //     ['office_location'=>'Mirpur 1'],
        //     ['working_days'=>'Mon-Fri'],
        //     ['visit_time'=>'7pm-10pm'],
        //     ['user_id'=>'1'],
        //     ['department_id'=>'1'],
        //     ['district_id'=>'4']
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
