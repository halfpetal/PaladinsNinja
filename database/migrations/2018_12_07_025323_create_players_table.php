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
            $table->bigInteger('player_id')->nullable();
            $table->timestamp('registered_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->integer('hours_played')->nullable();
            $table->integer('leaves')->nullable();
            $table->integer('level')->nullable();
            $table->integer('losses')->nullable();
            $table->integer('mastery_level')->nullable();
            $table->string('name')->nullable();
            $table->string('platform')->nullable();
            $table->string('region')->nullable()->nullable();
            $table->integer('tier_conquest')->nullable();
            $table->integer('total_achievements')->nullable();
            $table->integer('total_xp')->nullable();
            $table->integer('wins')->nullable();
            $table->json('ranked_conquest')->nullable();
            $table->json('match_history')->nullable();
            $table->json('friends')->nullable();
            $table->json('loadouts')->nullable();
            $table->json('champion_ranks')->nullable();
            $table->json('data')->nullable();
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
