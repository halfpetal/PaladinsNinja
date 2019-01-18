<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChampionTierlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champion_tierlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('Unnamed Tierlist');
            $table->text('description')->nullable()->default(null);
            $table->json('tier_s')->nullable()->default(null);
            $table->json('tier_a')->nullable()->default(null);
            $table->json('tier_b')->nullable()->default(null);
            $table->json('tier_c')->nullable()->default(null);
            $table->json('tier_d')->nullable()->default(null);
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('champion_tierlists');
    }
}
