<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_order', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('baseid');
            $table->string('siteid');
            $table->varbinary('relatedid', 64)->nullable();
            $table->varbinary('type', 64);
            $table->dateTime('datepayment')->nullable();
            $table->dateTime('datedelivery')->nullable();
            $table->smallInteger('statuspayment')->nullable();
            $table->smallInteger('statusdelivery')->nullable();
            $table->string('cdate', 10);
            $table->string('cmonth', 7);
            $table->string('cweek', 7);
            $table->string('cwday', 1);
            $table->string('chour', 2);
            $table->dateTime('ctime');
            $table->dateTime('mtime');
            $table->string('editor');
            
            $table->index(['siteid', 'type'], 'idx_msord_sid_type');
            $table->index(['siteid', 'ctime', 'statuspayment'], 'idx_msord_sid_ctime_pstat');
            $table->index(['siteid', 'mtime', 'statuspayment'], 'idx_msord_sid_mtime_pstat');
            $table->index(['siteid', 'mtime', 'statusdelivery'], 'idx_msord_sid_mtime_dstat');
            $table->index(['siteid', 'statusdelivery'], 'idx_msord_sid_dstatus');
            $table->index(['siteid', 'datedelivery'], 'idx_msord_sid_ddate');
            $table->index(['siteid', 'datepayment'], 'idx_msord_sid_pdate');
            $table->index(['siteid', 'editor'], 'idx_msord_sid_editor');
            $table->index(['siteid', 'cdate'], 'idx_msord_sid_cdate');
            $table->index(['siteid', 'cmonth'], 'idx_msord_sid_cmonth');
            $table->index(['siteid', 'cweek'], 'idx_msord_sid_cweek');
            $table->index(['siteid', 'cwday'], 'idx_msord_sid_cwday');
            $table->index(['siteid', 'chour'], 'idx_msord_sid_chour');
            $table->foreign('baseid', 'fk_msord_baseid')->references('id')->on('mshop_order_base')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_order');
    }
}
