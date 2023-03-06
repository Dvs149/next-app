<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveThreeFieldFromTeamAndColeguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_and_colegues', function (Blueprint $table) {
            $table->dropColumn(['tac_profile_photo', 'tac_name', 'tac_url']);
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
            $table->string('tac_profile_photo',255)->default(null)->nullable();
            $table->string('tac_name',255)->default(null)->nullable();
            $table->string('tac_url',255)->default(null)->nullable();
        });
    }
}
