<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('dorm')->nullable();
            $table->string('room')->nullable();
            $table->string('major')->nullable();
            $table->string('phone')->nullable();
            $table->string('tsirt_size')->nullable();
            $table->string('gender')->nullable();
            $table->string('image_confirm')->nullable();
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
        Schema::drop('mos');
    }
}
