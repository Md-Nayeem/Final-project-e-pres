<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('doctor_id')->constrained('doctors');
            $table->foreignId('checking_id')->constrained('checkings');
            $table->unsignedBigInteger('order_id')->unsigned()->nullable()->comment('The users prescription order');
            $table->text('disease');
            $table->text('symptoms');
            $table->text('procedure');
            $table->boolean('private')->default('1');
            $table->date('end_date');
            $table->date('next_visit');
            $table->string('digital_signature');
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
        Schema::dropIfExists('prescriptions');
    }
}
