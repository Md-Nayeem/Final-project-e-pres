<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('age');
            // $table->foreignId('gender')->constrained('gender_types');
            $table->char('gender',1);
            $table->char('blood_group',2);
            $table->text('allergies')->nullable();
            $table->float('height',5,2)->comment('In centimeters');
            $table->integer('weight')->comment('In Kg');
            $table->float('BMI',4,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
