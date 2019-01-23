<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTierSsToChampionTierlists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('champion_tierlists', function (Blueprint $table) {
            $table->json('tier_ss')->nullable()->default(null)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('champion_tierlists', function (Blueprint $table) {
            $table->dropColumn('tier_ss');
        });
    }
}
