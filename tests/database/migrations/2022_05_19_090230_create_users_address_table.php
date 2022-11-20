<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_address', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->unsignedBigInteger('parentid');
            $table->string('siteid');
            $table->string('company', 100);
            $table->string('vatid', 32);
            $table->string('salutation', 8);
            $table->string('title', 64);
            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('address1', 200)->index('idx_lvuad_address1');
            $table->string('address2', 200);
            $table->string('address3', 200);
            $table->string('postal', 16);
            $table->string('city', 200)->index('idx_lvuad_city');
            $table->string('state', 200);
            $table->string('langid', 5)->nullable();
            $table->string('countryid', 2)->nullable();
            $table->string('telephone', 32);
            $table->string('email')->index('idx_lvuad_email');
            $table->string('telefax');
            $table->string('website');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->date('birthday')->nullable();
            $table->smallInteger('pos');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['lastname', 'firstname'], 'idx_lvuad_last_first');
            $table->index(['postal', 'address1'], 'idx_lvuad_post_addr1');
            $table->index(['postal', 'city'], 'idx_lvuad_post_city');
            $table->foreign('parentid', 'fk_lvuad_pid')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_address');
    }
}
