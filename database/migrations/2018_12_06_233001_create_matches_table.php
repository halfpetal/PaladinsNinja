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
            $table->integer('queue_id')->nullable();
            $table->timestamp('match_date')->nullable();
            $table->string('region')->nullable();
            $table->integer('match_time_seconds')->nullable();
            $table->string('map_game')->nullable();
            $table->string('gamemode')->nullable();
            $table->integer('winning_task_force')->nullable();
            $table->integer('task_force_1_score')->nullable();
            $table->integer('task_force_2_score')->nullable();
            $table->json('task_force_1')->nullable();
            $table->json('task_force_2')->nullable();
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
