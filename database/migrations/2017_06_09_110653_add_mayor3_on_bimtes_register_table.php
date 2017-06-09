<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMayor3OnBimtesRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bimtes_register', function(Blueprint $table){
            $table->string('major3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bimtes_register', function(Blueprint $table){
            $table->dropColumn('major3');
        });
    }
}
