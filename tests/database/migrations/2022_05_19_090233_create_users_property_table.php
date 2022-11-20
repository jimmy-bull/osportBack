<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_property', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->unsignedBigInteger('parentid');
            $table->string('siteid');
            $table->varbinary('key', 103)->default('');
            $table->varbinary('type', 64);
            $table->string('langid', 5)->nullable();
            $table->string('value');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['parentid', 'siteid', 'type', 'langid', 'value'], 'unq_lvupr_sid_ty_lid_value');
            $table->index(['key', 'siteid'], 'fk_lvupr_key_sid');
            $table->foreign('parentid', 'fk_lvupr_pid')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_property');
    }
}
