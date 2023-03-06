<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLengthInBusinessInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_info', function (Blueprint $table) {
            $table->string('b_title', 255)->change();
            $table->string('b_company_name', 255)->change();
            $table->string('b_department', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_info', function (Blueprint $table) {
            $table->drop('b_title');
            $table->drop('b_company_name');
            $table->drop('b_department');
        });
    }
}
