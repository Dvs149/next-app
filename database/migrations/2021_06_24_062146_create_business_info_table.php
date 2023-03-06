<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_info', function (Blueprint $table) {
            $table->id();
            $table->string('b_bio',255);
            $table->string('b_name',30);
            $table->string('b_email',75);
            $table->string('b_title',25);
            $table->string('b_company_name',25);
            $table->string('b_department',25);
            $table->string('b_contact_number',12);
            $table->string('b_ext',10);
            $table->string('b_website',255);
            $table->string('b_whatsapp_url',255);
            $table->string('b_location_latitude',25);
            $table->string('b_location_longitute',25);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_info');
    }
}
