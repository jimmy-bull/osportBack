<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMadminQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('madmin_queue', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('queue');
            $table->string('cname', 32);
            $table->dateTime('rtime');
            $table->text('message');
            
            $table->index(['queue', 'rtime', 'cname'], 'idx_maque_queue_rtime_cname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('madmin_queue');
    }
}
