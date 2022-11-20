<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_rates', function (Blueprint $table) {
            $table->id();
            $table->string('wichteamrated');
            $table->float('punctuality');
            $table->float('fair_play');
            $table->float('teamrated');
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
        Schema::dropIfExists('team_rates');
    }
}


// wichteamrated, punctuality,fair_play,teamrated, 