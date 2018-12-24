<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGamemodeToMatchPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_players', function (Blueprint $table) {
            $table->string('Name')->nullable()->default('Legacy')->after('Map_Game');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_players', function (Blueprint $table) {
            $table->dropColumn('Name');
        });
    }
}
