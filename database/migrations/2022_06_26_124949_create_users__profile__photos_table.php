<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfilePhotosTable extends Migration
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
        Schema::create('users__profile__photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->longText('image');
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
        Schema::dropIfExists('users__profile__photos');
    }
}
