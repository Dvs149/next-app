<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovingTacTitleFromTeamTeamAndColeguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_and_colegues', function (Blueprint $table) {
            $table->dropColumn('tac_title');
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
            $table->string('tac_title',15)->nullable();
        });
    }
}
