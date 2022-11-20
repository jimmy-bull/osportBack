<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopOrderBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_order_base', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('siteid');
            $table->varbinary('customerid', 36);
            $table->varbinary('sitecode', 255)->nullable();
            $table->string('langid', 5);
            $table->string('currencyid', 3);
            $table->decimal('price', 12, 2);
            $table->decimal('costs', 12, 2);
            $table->decimal('rebate', 12, 2);
            $table->decimal('tax', 14, 4);
            $table->smallInteger('taxflag');
            $table->string('customerref')->nullable();
            $table->text('comment');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['customerid', 'sitecode'], 'idx_msordba_custid_scode');
            $table->index(['customerid', 'siteid'], 'idx_msordba_custid_sid');
            $table->index(['siteid', 'ctime'], 'idx_msordba_sid_ctime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_order_base');
    }
}
