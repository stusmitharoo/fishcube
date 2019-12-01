<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::hasTable('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('uid');
            $table->integer('style_id');
            $table->integer('district_id');
            $table->string('title');
            $table->text('description');
            $table->boolean('processed')->default(false);
            $table->string('video_id')->nullable();
            $table->string('video_filename');
            $table->boolean('allow_votes')->default(true);
            $table->integer('processed_percentage')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
