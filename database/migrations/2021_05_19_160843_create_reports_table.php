<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('revenue');
            $table->unsignedInteger('payments');
            $table->unsignedInteger('subscriptions');
            $table->unsignedInteger('time_maging');
            $table->unsignedInteger('exo_attempts');
            $table->unsignedInteger('exo_successes');
            $table->unsignedInteger('new_users');
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
        Schema::dropIfExists('reports');
    }
}
