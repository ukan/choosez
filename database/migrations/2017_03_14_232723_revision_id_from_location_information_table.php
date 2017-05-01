<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RevisionIdFromLocationInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_informations', function ($table) {
            $table->dropPrimary('id');
            $table->integer('id')->primary()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_informations', function ($table) {
            $table->dropPrimary('id');
            $table->integer('id')->primary()->change();

        });
    }
}
