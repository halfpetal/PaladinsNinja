<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('match_id')->unique();
            $table->integer('queue_id');
            $table->timestamp('match_date');
            $table->string('region');
            $table->integer('match_time_seconds');
            $table->string('map_game');
            $table->string('gamemode');
            $table->integer('winning_task_force');
            $table->integer('task_force_1_score');
            $table->integer('task_force_2_score');
            $table->json('task_force_1');
            $table->json('task_force_2');
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
        Schema::dropIfExists('matches');
    }
}
