<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_text', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->varbinary('type', 64);
            $table->string('langid', 5)->nullable();
            $table->string('domain', 32);
            $table->string('label');
            $table->mediumText('content');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['siteid', 'domain', 'status'], 'idx_mstex_sid_domain_status');
            $table->index(['siteid', 'domain', 'langid'], 'idx_mstex_sid_domain_langid');
            $table->index(['siteid', 'domain', 'label'], 'idx_mstex_sid_dom_label');
            $table->index(['siteid', 'domain', 'content`(255'], 'idx_mstex_sid_dom_cont');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_text');
    }
}
