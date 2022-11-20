<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopCustomerGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_customer_group', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid')->default('');
            $table->varbinary('code', 64);
            $table->string('label');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'code'], 'unq_mscusgr_sid_code');
            $table->index(['siteid', 'label'], 'idx_mscusgr_sid_label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_customer_group');
    }
}
