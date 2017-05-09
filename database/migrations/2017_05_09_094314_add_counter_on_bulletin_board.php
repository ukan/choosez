<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCounterOnBulletinBoard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buletin_boards', function(Blueprint $table){
            $table->integer('counter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buletin_boards', function(Blueprint $table){
            $table->dropColumn('counter');
        });
    }
}
