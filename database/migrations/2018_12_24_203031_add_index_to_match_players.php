<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToMatchPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_players', function (Blueprint $table) {
            $table->index(['playerId', 'Match']);
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
            $table->dropIndex(['playerId', 'Match']);
        });
    }
}
