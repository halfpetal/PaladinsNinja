<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInGameItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_game_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Description');
            $table->string('DeviceName');
            $table->integer('IconId');
            $table->integer('ItemId');
            $table->integer('Price');
            $table->string('ShortDesc')->nullable();
            $table->string('itemIcon_URL');
            $table->string('item_type');
            $table->integer('recharge_seconds');
            $table->integer('talent_reward_level');
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
        Schema::dropIfExists('in_game_items');
    }
}
