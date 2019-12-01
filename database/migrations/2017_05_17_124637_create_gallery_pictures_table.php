<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::hasTable('gallery_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('user_id');
            $table->increments('gallery_header_id');
            $table->increments('order_no');
            $table->date('date');
            $table->string('name');
            $table->string('species');
            $table->timestamps();
            $table->string('image');

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
        Schema::dropIfExists('gallery_pictures');
    }
}
