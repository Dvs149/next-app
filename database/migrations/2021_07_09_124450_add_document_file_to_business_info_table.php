<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentFileToBusinessInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_info', function (Blueprint $table) {
            $table->string('document_file',50)->default(null)->nullable()->after('b_location_longitute');
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
            $table->dropColumn('document_file');
        });
    }
}
