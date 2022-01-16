<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('name');
            $table->integer('chest_circumference');
            $table->integer('waistline');
            $table->integer('buttock_circumference');
            $table->integer('length_by_chest');
            $table->integer('chest_length');
            $table->integer('shoulder_length');
            $table->integer('back_view');
            $table->integer('neck_length');
            $table->integer('neck_width');
            $table->integer('neck_circumference');
            $table->integer('distance_between_breasts');
            $table->integer('arm_length');
            $table->integer('arm_circumference');
            $table->integer('armpit_length');
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
        Schema::dropIfExists('sizes');
    }
}
