<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->string('name');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
        Schema::drop('cities');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('citys');
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('countries_id')->nullable();
            $table->integer('provinces_id')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }
}
