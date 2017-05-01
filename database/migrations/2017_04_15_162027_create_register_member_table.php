<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_student', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('village')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
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
            $table->string('image')->nullable();
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
        Schema::drop('register_student');
    }
}
