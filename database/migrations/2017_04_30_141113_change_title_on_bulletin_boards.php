<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTitleOnBulletinBoards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buletin_boards', function (Blueprint $table) {
            $table->dropColumn('contributor')->nullable();
            $table->dropColumn('link_url')->nullable();
            $table->dropColumn('description')->nullable();
        });
        Schema::table('buletin_boards', function (Blueprint $table) {
            $table->string('author')->nullable();
            $table->string('status')->nullable();
            $table->text('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buletin_boards', function (Blueprint $table) {
            $table->dropColumn('author')->nullable();
            $table->dropColumn('status')->nullable();
            $table->dropColumn('content')->nullable();
        });
        Schema::table('buletin_boards', function (Blueprint $table) {
            $table->string('contributor')->nullable();
            $table->string('link_url')->nullable();
            $table->text('description')->nullable();
        });
    }
}
