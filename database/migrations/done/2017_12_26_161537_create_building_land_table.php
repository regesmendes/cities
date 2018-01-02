<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingLandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_land', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('building');
            
            $table->integer('land_id')->unsigned();
            $table->foreign('land_id')->references('id')->on('land');

            $table->integer('level')->unsigned()->default(1);

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
        Schema::dropIfExists('building_land');
    }
}
