<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',25);
            $table->string('user_number',25)->nullable();
            $table->string('email',100)->unique();
            $table->string('mobile',12)->unique()->nullable();
            $table->enum('role',['admin','user'])->default('user');
            $table->enum('type_of_account',['standard','premium'])->default('standard');
            $table->dateTime('expiration_date')->nullable(); 
            $table->mediumInteger('otp')->nullable(); 

            $table->string('facebook_link',255)->nullable();
            $table->string('snapchat_link',255)->nullable();
            $table->string('twitter_link',255)->nullable();
            $table->string('tiktok_link',255)->nullable();
            $table->string('linkedin_link',255)->nullable();
            $table->string('instagram_link',255)->nullable();
            $table->string('youtube_link',255)->nullable();

            $table->enum('facebook_visibility',[0,1])->nullable();
            $table->enum('snapchat_visibility',[0,1])->nullable();
            $table->enum('twitter_visibility',[0,1])->nullable();
            $table->enum('tiktok_visibility',[0,1])->nullable();
            $table->enum('linkedin_visibility',[0,1])->nullable();
            $table->enum('instagram_visibility',[0,1])->nullable();
            $table->enum('youtube_visibility',[0,1])->nullable();

            $table->tinyInteger('facebook_order')->nullable();
            $table->tinyInteger('snapchat_order')->nullable();
            $table->tinyInteger('twitter_order')->nullable();
            $table->tinyInteger('tiktok_order')->nullable();
            $table->tinyInteger('linkedin_order')->nullable();
            $table->tinyInteger('instagram_order')->nullable();
            $table->tinyInteger('youtube_order')->nullable();

            $table->string('profile_photo',150)->nullable();
            $table->string('cover_photo',150)->nullable();
            $table->string('youtube_video_link',300)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
