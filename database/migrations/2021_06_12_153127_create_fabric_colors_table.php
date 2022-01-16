<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fabric_id')->unsigned();
            $table->integer('color_id')->unsigned();
            $table->unique(['fabric_id','color_id']);
            $table->foreign('fabric_id')->references('id')->on('fabrics')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fabric_colors');
    }
}
