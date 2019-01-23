<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewRankedFieldsToPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->integer('tier_ranked_kbm')->nullable()->default(null)->after('tier_conquest');
            $table->integer('tier_ranked_controller')->nullable()->default(null)->after('tier_ranked_kbm');
            $table->json('ranked_kbm')->nullable()->default(null)->after('ranked_conquest');
            $table->json('ranked_controller')->nullable()->default(null)->after('ranked_kbm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('tier_ranked_kbm');
            $table->dropColumn('tier_ranked_controller');
            $table->dropColumn('ranked_kbm');
            $table->dropColumn('ranked_controller');
        });
    }
}