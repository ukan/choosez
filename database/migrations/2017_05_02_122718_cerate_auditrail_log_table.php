<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CerateAuditrailLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditrail_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable(); 
            $table->string('action')->nullable(); 
            $table->string('table_name')->nullable(); 
            $table->text('before')->nullable(); 
            $table->text('after')->nullable(); 
            $table->text('content')->nullable(); 
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
        Schema::drop('auditrail_log');
    }
}
