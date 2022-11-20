<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopOrderBaseServiceAttrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_order_base_service_attr', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('ordservid');
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
            
            $table->unique(['ordservid', 'attrid', 'type', 'code'], 'unq_msordbaseat_oid_aid_ty_cd');
            $table->index(['siteid', 'code', 'value`(16'], 'idx_msordbaseat_si_cd_va');
            $table->foreign('ordservid', 'fk_msordbaseat_ordservid')->references('id')->on('mshop_order_base_service')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_order_base_service_attr');
    }
}
