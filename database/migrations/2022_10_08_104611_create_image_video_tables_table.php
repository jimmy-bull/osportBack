<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageVideoTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_video_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->string("type");
            $table->longText("link");
            $table->foreign('post_id')
                ->references('id')->on('post_tables')->onDelete('cascade');
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
        Schema::dropIfExists('image_video_tables');
    }
}
