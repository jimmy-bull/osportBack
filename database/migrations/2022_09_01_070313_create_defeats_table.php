<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defeats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->bigInteger('score');
            $table->string('looser_mail');
            $table->string('looser_team');
            $table->foreign('game_id')
                ->references('id')->on('ask_games')->onDelete('cascade');
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
        Schema::dropIfExists('defeats');
    }
}
