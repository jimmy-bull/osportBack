<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopOrderBaseServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_order_base_service', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('baseid');
            $table->string('siteid');
            $table->varbinary('servid', 36);
            $table->varbinary('type', 64);
            $table->varbinary('code', 64);
            $table->string('name');
            $table->string('mediaurl');
            $table->string('currencyid', 3);
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('costs', 12, 2);
            $table->decimal('rebate', 12, 2);
            $table->decimal('tax', 14, 4);
            $table->string('taxrate');
            $table->smallInteger('taxflag')->default(1);
            $table->integer('pos')->default(0);
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['baseid', 'siteid', 'code', 'type'], 'unq_msordbase_bid_sid_cd_typ');
            $table->index(['siteid', 'code', 'type'], 'idx_msordbase_sid_code_type');
            $table->foreign('baseid', 'fk_msordbase_baseid')->references('id')->on('mshop_order_base')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_order_base_service');
    }
}
