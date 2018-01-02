<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_user', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('land_id')->unsigned()->unique();
            $table->foreign('land_id')->references('id')->on('land');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('name', 50);
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
        Schema::dropIfExists('land_user');
    }
}
