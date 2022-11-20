<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeammembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teammembers', function (Blueprint $table) {
            $table->id();
            $table->string('team_to_join');
            $table->string('who_want_to_join');
            $table->string('team_to_join_owner');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    // team_to_join
    // who_want_to_join
    // team_to_join_owner 
    // status = accepeted; refused; pending; 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teammembers');
    }
}
