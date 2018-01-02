<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build_time', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('building');
            
            $table->integer('level')->unsigned();
            $table->time('build_time');
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
        Schema::dropIfExists('build_time');
    }
}
