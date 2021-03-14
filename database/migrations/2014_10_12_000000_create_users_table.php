<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->char('phone',11);
            $table->unsignedBigInteger('photo_id')->unsigned()->nullable()->comment('The users photo');
            $table->unsignedBigInteger('role_id')->index()->unsigned()->nullable()->comment('The role in which the user belongs to');
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            /**
             * This part is necessary for us to use the soft-delete feature.
             */
            // $table->softDeletes();
             // Constraints
            // $table->foreign('role_id')->references('id')->on('roles');

        });

        // DB::table('users')->insert([
        //     ['name'=>'Md Nayeem'],
        //     ['email'=>'nayeem@gmail.com'],
        //     ['phone'=>'01784521451'],
        //     ['photo_id'=>'1'],
        //     ['role_id'=>''],
        //     ['password'=>'$2y$10$hov/E.UrYpYR7CcBSYUL/uXK0cXLj6Q7TqEGUChTy48EmC5JTVPeG']
        // ]);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
