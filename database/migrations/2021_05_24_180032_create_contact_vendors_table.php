<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->string('address_request')->nullable();
            $table->text('message');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
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
        Schema::dropIfExists('contact_vendors');
    }
}
