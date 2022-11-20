<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopProductListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_product_list', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parentid');
            $table->string('siteid');
            $table->varbinary('key', 134)->default('');
            $table->varbinary('type', 64);
            $table->string('domain', 32);
            $table->varbinary('refid', 36);
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->text('config');
            $table->integer('pos');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['parentid', 'domain', 'siteid', 'type', 'refid'], 'unq_msproli_pid_dm_sid_ty_rid');
            $table->index(['key', 'siteid'], 'idx_msproli_key_sid');
            $table->foreign('parentid', 'fk_msproli_pid')->references('id')->on('mshop_product')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_product_list');
    }
}
