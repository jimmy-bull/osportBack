<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_catalog', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parentid')->nullable();
            $table->string('siteid');
            $table->smallInteger('level');
            $table->varbinary('code', 64);
            $table->string('label');
            $table->string('url')->default('');
            $table->text('config');
            $table->integer('nleft');
            $table->integer('nright');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            $table->string('target');
            
            $table->unique(['siteid', 'code'], 'unq_mscat_sid_code');
            $table->index(['siteid', 'nleft', 'nright', 'level', 'parentid'], 'idx_mscat_sid_nlt_nrt_lvl_pid');
            $table->index(['siteid', 'status'], 'idx_mscat_sid_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_catalog');
    }
}
