<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            /**
             * This part is necessary for us to use the soft-delete feature.
             */
            $table->softDeletes();
        });
        
        //sample data
        DB::table('districts')->insert([
            ['name'=>'Dhaka'],
            ['name'=>'Sylhet'],
            ['name'=>'Mymensingh'],
            ['name'=>'Comilla'],
            ['name'=>'Barisal'],
            ['name'=>'Rajshahi'],
            ['name'=>'Chittagong']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
