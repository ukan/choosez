<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeveralColumnOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
          $table->string('place_of_birth')->nullable();
          $table->string('rt')->nullable();
          $table->string('rw')->nullable();
          $table->string('village')->nullable();
          $table->string('sd')->nullable();
          $table->string('sd_th')->nullable();
          $table->string('sltp')->nullable();
          $table->string('sltp_th')->nullable();
          $table->string('slta')->nullable();
          $table->string('slta_th')->nullable();
          $table->text('mbs')->nullable();
          $table->string('university')->nullable();
          $table->string('faculty')->nullable();
          $table->string('major')->nullable();
          $table->string('semester')->nullable();
          $table->string('father_name')->nullable();
          $table->string('fahter_age')->nullable();
          $table->string('f_last_study')->nullable();
          $table->string('f_current_job')->nullable();
          $table->string('mother_name')->nullable();
          $table->string('mother_age')->nullable();
          $table->string('m_last_study')->nullable();
          $table->string('m_current_job')->nullable();
          $table->dropColumn('avatar');
          $table->string('image')->nullable();
          $table->dropColumn('last_name');
          $table->dropColumn('permissions');
          $table->dropColumn('location_information_id');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('place_of_birth')->nullable();
        $table->dropColumn('rt')->nullable();
        $table->dropColumn('rw')->nullable();
        $table->dropColumn('village')->nullable();
        $table->dropColumn('sd')->nullable();
        $table->dropColumn('sd_th')->nullable();
        $table->dropColumn('sltp')->nullable();
        $table->dropColumn('sltp_th')->nullable();
        $table->dropColumn('slta')->nullable();
        $table->dropColumn('slta_th')->nullable();
        $table->dropColumn('mbs')->nullable();
        $table->dropColumn('university')->nullable();
        $table->dropColumn('faculty')->nullable();
        $table->dropColumn('major')->nullable();
        $table->dropColumn('semester')->nullable();
        $table->dropColumn('father_name')->nullable();
        $table->dropColumn('fahter_age')->nullable();
        $table->dropColumn('f_last_study')->nullable();
        $table->dropColumn('f_current_job')->nullable();
        $table->dropColumn('mother_name')->nullable();
        $table->dropColumn('mother_age')->nullable();
        $table->dropColumn('m_last_study')->nullable();
        $table->dropColumn('m_current_job')->nullable();
        $table->dropColumn('image')->nullable();
        $table->string('avatar')->nullable();
        $table->string('last_name')->nullable();
        $table->string('permissions')->nullable();
        $table->string('location_information_id')->nullable();
    });
  }
}
