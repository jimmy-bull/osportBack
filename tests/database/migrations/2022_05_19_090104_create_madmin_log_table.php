<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMadminLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('madmin_log', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('siteid')->default('');
            $table->string('facility', 32);
            $table->dateTime('timestamp');
            $table->smallInteger('priority');
            $table->mediumText('message');
            $table->string('request', 32);
            
            $table->index(['siteid', 'timestamp', 'facility', 'priority'], 'idx_malog_sid_time_facility_prio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('madmin_log');
    }
}
