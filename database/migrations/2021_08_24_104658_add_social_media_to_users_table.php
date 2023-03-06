<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialMediaToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('podcast_link',255)->nullable()->after('youtube_link');
            $table->string('soundcloud_link',255)->nullable()->after('youtube_link');
            $table->string('behance_link',255)->nullable()->after('youtube_link');

            $table->enum('podcast_visibility',[0,1])->nullable()->after('youtube_visibility');
            $table->enum('soundcloud_visibility',[0,1])->nullable()->after('youtube_visibility');
            $table->enum('behance_visibility',[0,1])->nullable()->after('youtube_visibility');

            $table->tinyInteger('podcast_order')->nullable()->after('youtube_order');
            $table->tinyInteger('soundcloud_order')->nullable()->after('youtube_order');
            $table->tinyInteger('behance_order')->nullable()->after('youtube_order');
            
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
            //
        });
    }
}
