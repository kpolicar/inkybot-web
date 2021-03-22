<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMagePublishesTableAddDontPublishToForum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mage_publishes', function (Blueprint $table) {
            $table->boolean('dont_publish_to_forum')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mage_publishes', function (Blueprint $table) {
            $table->dropColumn('dont_publish_to_forum');
        });
    }
}
