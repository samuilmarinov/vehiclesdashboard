<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {

            $table->increments('id');
            $table->string('version');
            $table->longText('info')->nullable();
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->integer('model_id')->unsigned();
            $table->foreign('model_id')->references('id')->on('vehicle_models');
            $table->integer('bodywork_id')->unsigned();
            $table->foreign('bodywork_id')->references('id')->on('bodyworks');
            $table->integer('engine_id')->unsigned();
            $table->foreign('engine_id')->references('id')->on('engines');
            $table->integer('color_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colors'); 
            $table->string('image')->nullable();
            $table->string('imageurl')->nullable();
            $table->string('_token')->nullable();
            $table->boolean('status')->default(0);   
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
