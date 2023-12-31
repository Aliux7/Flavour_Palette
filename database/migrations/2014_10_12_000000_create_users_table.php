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
            $table->string('id')->primary();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('username');
            $table->string('fullname');
            $table->string('password');
            $table->string('gender');
            $table->string('status');
            $table->date('dob');
            $table->string('role')->default('customer');
            $table->string('profile_picture')->default('DefaultProfile.png');
            $table->rememberToken();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
