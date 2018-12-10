<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChampionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('champion_id')->nullable();
            $table->integer('health')->nullable();
            $table->integer('speed')->nullable();
            $table->boolean('onfreerotation')->nullable()->default(false);
            $table->string('name')->nullable();
            $table->string('role')->nullable();
            $table->string('title')->nullable();
            $table->string('icon_url')->nullable();
            $table->json('data')->nullable();
            $table->json('cards')->nullable();
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
        Schema::dropIfExists('champions');
    }
}
