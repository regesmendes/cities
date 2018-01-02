<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_resource', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('land_id')->unsigned();
            $table->foreign('land_id')->references('id')->on('land');
            
            $table->integer('resource_id')->unsigned();
            $table->foreign('resource_id')->references('id')->on('resource');
            
            $table->bigInteger('quantity');
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
        Schema::dropIfExists('land_resource');
    }
}
