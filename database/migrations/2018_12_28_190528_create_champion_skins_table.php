<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChampionSkinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champion_skins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('champion_id')->nullable();
            $table->string('rarity')->nullable();
            $table->integer('skin_id1')->nullable();
            $table->integer('skin_id2')->nullable();
            $table->string('skin_name')->nullable();
            $table->string('skin_name_english')->nullable();
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
        Schema::dropIfExists('champion_skins');
    }
}
