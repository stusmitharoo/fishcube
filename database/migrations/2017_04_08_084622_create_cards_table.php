<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::hasTable('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('user_id');
            $table->increments('style_id');
            $table->increments('gallery_header_id')->nullable();
            $table->increments('video_id')->nullable();
            $table->increments('blog_id')->nullable();
            $table->increments('district_id')->nullable();
            $table->increments('fish_id')->nullable();
            $table->increments('lbs')->nullable();
            $table->increments('ozs')->nullable();
            $table->increments('dr')->nullable();
            $table->date('capture_date');
            $table->string('display_description');
            $table->string('profile_description')->nullable();
            $table->string('image');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
