<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopPluginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_plugin', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->varbinary('type', 64);
            $table->string('label');
            $table->string('provider');
            $table->text('config');
            $table->integer('pos');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'type', 'provider'], 'unq_msplu_sid_ty_prov');
            $table->index(['siteid', 'provider'], 'idx_msplu_sid_prov');
            $table->index(['siteid', 'status'], 'idx_msplu_sid_status');
            $table->index(['siteid', 'label'], 'idx_msplu_sid_label');
            $table->index(['siteid', 'pos'], 'idx_msplu_sid_pos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_plugin');
    }
}
