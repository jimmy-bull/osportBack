<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMadminJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('madmin_job', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('siteid');
            $table->string('label');
            $table->string('path');
            $table->smallInteger('status');
            $table->dateTime('ctime');
            $table->dateTime('mtime');
            $table->string('editor');
            
            $table->index(['siteid', 'ctime'], 'idx_majob_sid_ctime');
            $table->index(['siteid', 'status'], 'idx_majob_sid_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('madmin_job');
    }
}
