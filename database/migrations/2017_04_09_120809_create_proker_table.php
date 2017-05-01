<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proker', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bidang_id')->unsigned()->nullable();
            $table->text('proker_mingguan')->nullable();
            $table->text('proker_bulanan')->nullable();
            $table->text('proker_tahunan')->nullable();
            $table->text('proker_kondisional')->nullable();
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
        Schema::drop('proker');
    }
}
