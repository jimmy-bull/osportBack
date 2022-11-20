<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_order_status', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('parentid');
            $table->string('siteid');
            $table->varbinary('type', 64);
            $table->string('value', 64);
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['siteid', 'parentid', 'type', 'value'], 'idx_msordstatus_val_sid');
            $table->foreign('parentid', 'fk_msordst_pid')->references('id')->on('mshop_order')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_order_status');
    }
}
