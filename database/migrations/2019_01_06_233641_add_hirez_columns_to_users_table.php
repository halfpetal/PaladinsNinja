<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHirezColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('paladins_player_id')->unique()->nullable()->after('email_verified_at');
            $table->integer('hirez_account_id')->unique()->nullable()->after('email_verified_at');
            $table->timestamp('linked_hirez_at')->nullable()->after('email_verified_at');

            $table->index('paladins_player_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('paladins_player_id');
            $table->dropColumn('hirez_account_id');
            $table->dropColumn('linked_hirez_at');
        });
    }
}