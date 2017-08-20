<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnJenisKegiatanOnMosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mos', function (Blueprint $table) {
            $table->string('taaruf')->nullable();
            $table->string('lpks')->default('Tidak');
            $table->string('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mos', function (Blueprint $table) {
            $table->dropColumn('taaruf');
            $table->dropColumn('lpks');
            $table->dropColumn('password');
        });
    }
}
