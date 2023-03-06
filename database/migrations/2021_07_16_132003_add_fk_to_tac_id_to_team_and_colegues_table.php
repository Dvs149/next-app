<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToTacIdToTeamAndColeguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_and_colegues', function (Blueprint $table) {
            $table->bigInteger('tac_id')->unsigned()->change();
            $table->foreign('tac_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_and_colegues', function (Blueprint $table) {
            $table->dropForeign(['tac_id']);
        });
    }
}
