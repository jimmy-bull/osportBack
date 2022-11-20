<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMadminCacheTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('madmin_cache_tag', function (Blueprint $table) {
            $table->string('tid');
            $table->string('tname');
            
            $table->unique(['tid', 'tname'], 'unq_macacta_tid_tname');
            $table->foreign('tid', 'fk_macacta_tid')->references('id')->on('madmin_cache')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('madmin_cache_tag');
    }
}
