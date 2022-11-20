<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopAttributeListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_attribute_list', function (Blueprint $table) {
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
            
            $table->unique(['parentid', 'domain', 'siteid', 'type', 'refid'], 'unq_msattli_pid_dm_sid_ty_rid');
            $table->index(['key', 'siteid'], 'idx_msattli_key_sid');
            $table->foreign('parentid', 'fk_msattli_pid')->references('id')->on('mshop_attribute')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_attribute_list');
    }
}
