<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMadminCacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('madmin_cache', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->dateTime('expire')->nullable()->index('idx_majob_expire');
            $table->mediumText('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('madmin_cache');
    }
}
