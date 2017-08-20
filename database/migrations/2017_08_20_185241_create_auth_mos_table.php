<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthMosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_log_mos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mos_register_id')->unsigned()->nullable();
            $table->string('ip_address')->nullable();
            $table->string('login')->nullable();
            $table->string('logout')->nullable();
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
        Schema::drop('auth_log_mos');
    }
}
