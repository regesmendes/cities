<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_resource', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('building');

            $table->integer('resource_id')->unsigned();
            $table->foreign('resource_id')->references('id')->on('resource');

            $table->integer('level')->default(1);
            $table->enum('type', ['cost', 'production', 'consumption']);
            $table->integer('base')->default(1);
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
        Schema::dropIfExists('building_resource');
    }
}
