<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAskGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_games', function (Blueprint $table) {
            $table->id();
            $table->string('who_is_asking');
            $table->string('who_was_asked');
            $table->string('date_of_game');
            $table->string('hours_of_game');
            $table->string('place_of_game');
            $table->string('team_of_asker');
            $table->string('team_of_who_was_asked');
            $table->timestamps();
        });
    }

    // who_is_asking
    // who_was_asked
    // date_of_game
    // hours_of_game
    // place_of_game
    // team_of_asker
    // team_of_who_was_asked

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ask_games');
    }
}
