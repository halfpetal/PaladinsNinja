<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id');
            $table->timestamp('registered_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->integer('hours_played');
            $table->integer('leaves');
            $table->integer('level');
            $table->integer('losses');
            $table->integer('mastery_level');
            $table->string('name');
            $table->string('platform');
            $table->string('region');
            $table->integer('tier_conquest');
            $table->integer('total_achievements');
            $table->integer('total_xp');
            $table->integer('wins');
            $table->json('ranked_conquest');
            $table->json('match_history');
            $table->json('friends');
            $table->json('loadouts');
            $table->json('champion_ranks');
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
        Schema::dropIfExists('players');
    }
}
