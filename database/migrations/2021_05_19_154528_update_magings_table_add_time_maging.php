<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMagingsTableAddTimeMaging extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('magings', function (Blueprint $table) {
            $table->unsignedInteger('time_maging')->after('expended')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('magings', function (Blueprint $table) {
            $table->dropColumn('time_maging');
        });
    }
}
