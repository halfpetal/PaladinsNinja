<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ActiveId1')->nullable();
            $table->integer('ActiveId2')->nullable();
            $table->integer('ActiveId3')->nullable();
            $table->integer('ActiveId4')->nullable();
            $table->integer('ActiveLevel1')->nullable();
            $table->integer('ActiveLevel2')->nullable();
            $table->integer('ActiveLevel3')->nullable();
            $table->integer('ActiveLevel4')->nullable();
            $table->integer('Assists')->nullable();
            $table->integer('BanId1')->nullable();
            $table->integer('BanId2')->nullable();
            $table->integer('BanId3')->nullable();
            $table->integer('BanId4')->nullable();
            $table->integer('Camps_Cleared')->nullable();
            $table->integer('ChampionId')->nullable();
            $table->integer('Damage_Bot')->nullable();
            $table->integer('Damage_Done_In_Hand')->nullable();
            $table->integer('Damage_Done_Magical')->nullable();
            $table->integer('Damage_Done_Physical')->nullable();
            $table->integer('Damage_Mitigated')->nullable();
            $table->integer('Damage_Player')->nullable();
            $table->integer('Damage_Taken')->nullable();
            $table->integer('Damage_Taken_Magical')->nullable();
            $table->integer('Damage_Taken_Physical')->nullable();
            $table->integer('Deaths')->nullable();
            $table->integer('Distance_Traveled')->nullable();
            $table->integer('Final_Match_Level')->nullable();
            $table->integer('Gold_Earned')->nullable();
            $table->integer('Gold_Per_Minute')->nullable();
            $table->integer('Healing')->nullable();
            $table->integer('Healing_Bot')->nullable();
            $table->integer('Healing_Player_Self')->nullable();
            $table->integer('ItemId1')->nullable();
            $table->integer('ItemId2')->nullable();
            $table->integer('ItemId3')->nullable();
            $table->integer('ItemId4')->nullable();
            $table->integer('ItemId5')->nullable();
            $table->integer('ItemId6')->nullable();
            $table->integer('ItemLevel1')->nullable();
            $table->integer('ItemLevel2')->nullable();
            $table->integer('ItemLevel3')->nullable();
            $table->integer('ItemLevel4')->nullable();
            $table->integer('ItemLevel5')->nullable();
            $table->integer('ItemLevel6')->nullable();
            $table->integer('Killing_Spree')->nullable();
            $table->integer('Kills_Bot')->nullable();
            $table->integer('Kills_Double')->nullable();
            $table->integer('Kills_Fire_Giant')->nullable();
            $table->integer('Kills_First_Blood')->nullable();
            $table->integer('Kills_Gold_Fury')->nullable();
            $table->integer('Kills_Penta')->nullable();
            $table->integer('Kills_Phoenix')->nullable();
            $table->integer('Kills_Player')->nullable();
            $table->integer('Kills_Quadra')->nullable();
            $table->integer('Kills_Siege_Juggernaut')->nullable();
            $table->integer('Kills_Single')->nullable();
            $table->integer('Kills_Triple')->nullable();
            $table->integer('Kills_Wild_Juggernaut')->nullable();
            $table->integer('League_Losses')->nullable();
            $table->integer('League_Points')->nullable();
            $table->integer('League_Tier')->nullable();
            $table->integer('League_Wins')->nullable();
            $table->bigInteger('Match')->nullable();
            $table->integer('Multi_kill_Max')->nullable();
            $table->integer('Objective_Assists')->nullable();
            $table->integer('PartyId')->nullable();
            $table->integer('Rank_Stat_League')->nullable();
            $table->integer('SkinId')->nullable();
            $table->integer('Structure_Damage')->nullable();
            $table->integer('Surrendered')->nullable();
            $table->integer('TaskForce')->nullable();
            $table->integer('Team1Score')->nullable();
            $table->integer('Team2Score')->nullable();
            $table->integer('TeamId')->nullable();
            $table->integer('Time_In_Match_Seconds')->nullable();
            $table->integer('Towers_Destroyed')->nullable();
            $table->integer('Wards_Placed')->nullable();
            $table->integer('Winning_TaskForce')->nullable();
            $table->bigInteger('playerId')->nullable();
            $table->integer('match_queue_id')->nullable();
            $table->string('Entry_Datetime')->nullable();
            $table->string('Map_Game')->nullable();
            $table->string('Platform')->nullable();
            $table->string('Reference_Name')->nullable();
            $table->string('Region')->nullable();
            $table->string('Skin')->nullable();
            $table->string('Win_Status')->nullable();
            $table->string('champion_role')->nullable();
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
        Schema::dropIfExists('match_players');
    }
}
