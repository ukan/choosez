<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusOnBimtesRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bimtes_register', function(Blueprint $table){
            $table->string('status')->default('Not Yet Checked');
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
            $table->dropColumn('status');
        });
    }
}
