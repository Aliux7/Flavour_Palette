<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('profile_menu')->default('MenuProfile.png');
            $table->string('catering_id');
            $table->foreign('catering_id')->references('id')->on('caterings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('status');
            $table->integer('price');
            $table->integer('ordered')->default(0);
            $table->string('description');
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
        Schema::dropIfExists('menus');
    }
}
