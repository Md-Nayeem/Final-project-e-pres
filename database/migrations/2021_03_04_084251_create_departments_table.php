<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            /**
             * This part is necessary for us to use the soft-delete feature.
             */
            $table->softDeletes();
        });

        DB::table('departments')->insert([
            ['name'=>'Medicine'],
            ['name'=>'Cardiology'],
            ['name'=>'Paediatrics'],
            ['name'=>'Gastroenerology'],
            ['name'=>'Orthopaedics'],
            ['name'=>'Dentistry'],
            ['name'=>'Anaesthesiology'],
            ['name'=>'Orthopaedics'],
            ['name'=>'Obstetrics & Gynaecology']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
