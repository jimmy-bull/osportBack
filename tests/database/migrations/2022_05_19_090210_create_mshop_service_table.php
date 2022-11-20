<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_service', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->varbinary('type', 64);
            $table->varbinary('code', 64);
            $table->string('label');
            $table->string('provider');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->text('config');
            $table->integer('pos');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'code'], 'unq_msser_siteid_code');
            $table->index(['siteid', 'status', 'start', 'end'], 'idx_msser_sid_stat_start_end');
            $table->index(['siteid', 'provider'], 'idx_msser_sid_prov');
            $table->index(['siteid', 'code'], 'idx_msser_sid_code');
            $table->index(['siteid', 'label'], 'idx_msser_sid_label');
            $table->index(['siteid', 'pos'], 'idx_msser_sid_pos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_service');
    }
}
