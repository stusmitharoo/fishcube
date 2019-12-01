<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileFishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::hasTable('profile_fish', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('user_id');
            $table->string('name');
            $table->string('image');
            $table->increments('district_id');
            $table->increments('style_id');
            $table->increments('profile_distict_id');
            $table->increments('fish_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('profile_distict_id')->references('id')->on('profile_Districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_fish');
    }
}
