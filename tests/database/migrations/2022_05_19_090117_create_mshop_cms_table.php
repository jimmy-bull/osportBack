<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_cms', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->string('url');
            $table->string('label');
            $table->smallInteger('status');
            $table->dateTime('ctime');
            $table->dateTime('mtime');
            $table->string('editor');
            
            $table->unique(['siteid', 'url'], 'unq_mscms_sid_url');
            $table->index(['siteid', 'status'], 'unq_mscms_sid_status');
            $table->index(['siteid', 'label'], 'unq_mscms_sid_label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_cms');
    }
}
