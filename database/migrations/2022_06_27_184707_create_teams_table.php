<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table equipe:
     * id,
     * email du  createur de l'equipe,
     * nom de l'equipe,
     * le sport de l'equipe,
     * logo de l'equipe,
     * image de couverture de l'equipe,
     * ville de l'equipe,
     * 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('team_name');
            $table->string('sport_name');
            $table->string('logo');
            $table->string('cover');
            $table->string('city');
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
        Schema::dropIfExists('teams');
    }
}
