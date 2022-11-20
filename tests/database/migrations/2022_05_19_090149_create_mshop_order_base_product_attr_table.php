<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopOrderBaseProductAttrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_order_base_product_attr', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('ordprodid');
            $table->string('siteid');
            $table->varbinary('attrid', 36);
            $table->varbinary('type', 64);
            $table->varbinary('code', 255);
            $table->string('name');
            $table->text('value');
            $table->double('quantity');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['ordprodid', 'attrid', 'type', 'code'], 'unq_msordbaprat_oid_aid_ty_cd');
            $table->index(['siteid', 'code', 'value`(16'], 'idx_msordbaprat_si_cd_va');
            $table->foreign('ordprodid', 'fk_msordbaprat_ordprodid')->references('id')->on('mshop_order_base_product')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_order_base_product_attr');
    }
}
