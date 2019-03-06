<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingColumnsToMatchPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_players', function (Blueprint $table) {
            $table->string('Ban_1')->after('champion_role')->nullable()->default(null);
            $table->string('Ban_2')->after('champion_role')->nullable()->default(null);
            $table->string('Ban_3')->after('champion_role')->nullable()->default(null);
            $table->string('Ban_4')->after('champion_role')->nullable()->default(null);
            $table->string('Team_Name')->after('champion_role')->nullable()->default(null);
            $table->string('hasReplay')->after('champion_role')->nullable()->default(null);
            $table->string('playerName')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Purch_1')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Purch_2')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Purch_3')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Purch_4')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Purch_5')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Purch_6')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Active_1')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Active_2')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Active_3')->after('champion_role')->nullable()->default(null);
            $table->string('Item_Active_4')->after('champion_role')->nullable()->default(null);
            $table->string('playerPortalId')->after('champion_role')->nullable()->default(null);
            $table->string('playerPortalUserId')->after('champion_role')->nullable()->default(null);
            $table->integer('Minutes')->after('champion_role')->nullable()->default(null);
            $table->integer('Input_Type')->after('champion_role')->nullable()->default(null);
            $table->integer('Account_Level')->after('champion_role')->nullable()->default(null);
            $table->integer('Mastery_Level')->after('champion_role')->nullable()->default(null);
            $table->integer('Platform_Type')->after('champion_role')->nullable()->default(null);
            $table->integer('Match_Duration')->after('champion_role')->nullable()->default(null);
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
            $table->dropColumn('Ban_1');
            $table->dropColumn('Ban_2');
            $table->dropColumn('Ban_3');
            $table->dropColumn('Ban_4');
            $table->dropColumn('Team_Name');
            $table->dropColumn('hasReplay');
            $table->dropColumn('playerName');
            $table->dropColumn('Item_Purch_1');
            $table->dropColumn('Item_Purch_2');
            $table->dropColumn('Item_Purch_3');
            $table->dropColumn('Item_Purch_4');
            $table->dropColumn('Item_Purch_5');
            $table->dropColumn('Item_Purch_6');
            $table->dropColumn('Item_Active_1');
            $table->dropColumn('Item_Active_2');
            $table->dropColumn('Item_Active_3');
            $table->dropColumn('Item_Active_4');
            $table->dropColumn('playerPortalId');
            $table->dropColumn('playerPortalUserId');
            $table->dropColumn('Minutes');
            $table->dropColumn('Input_Type');
            $table->dropColumn('Account_Level');
            $table->dropColumn('Mastery_Level');
            $table->dropColumn('Platform_Type');
            $table->dropColumn('Match_Duration');
        });
    }
}
