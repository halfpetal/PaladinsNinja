<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('rating');
            $table->string('title');
            $table->text('body');
            $table->morphs('rateable');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('match_id')->nullable()->index();
            $table->index('rateable_id');
            $table->index('rateable_type');
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('ratings');
    }
}
