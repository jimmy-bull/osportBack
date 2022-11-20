<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_stock', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->varbinary('prodid', 36);
            $table->varbinary('type', 64);
            $table->integer('stocklevel')->nullable();
            $table->dateTime('backdate')->nullable();
            $table->string('timeframe', 16)->default('');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'prodid', 'type'], 'unq_mssto_sid_pid_ty');
            $table->index(['siteid', 'stocklevel'], 'idx_mssto_sid_stocklevel');
            $table->index(['siteid', 'backdate'], 'idx_mssto_sid_backdate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_stock');
    }
}
