<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_tag', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->varbinary('type', 64);
            $table->string('langid', 5)->nullable();
            $table->string('domain', 32);
            $table->string('label');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'domain', 'type', 'langid', 'label'], 'unq_mstag_sid_dom_ty_lid_lab');
            $table->index(['siteid', 'domain', 'langid'], 'idx_mstag_sid_dom_langid');
            $table->index(['siteid', 'domain', 'label'], 'idx_mstag_sid_dom_label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_tag');
    }
}
