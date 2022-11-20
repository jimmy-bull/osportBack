<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_price', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->varbinary('type', 64);
            $table->string('domain', 32);
            $table->string('label');
            $table->string('currencyid', 3);
            $table->double('quantity');
            $table->decimal('value', 12, 2)->nullable();
            $table->decimal('costs', 12, 2);
            $table->decimal('rebate', 12, 2);
            $table->string('taxrate');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['siteid', 'domain', 'currencyid'], 'idx_mspri_sid_dom_currid');
            $table->index(['siteid', 'domain', 'quantity'], 'idx_mspri_sid_dom_quantity');
            $table->index(['siteid', 'domain', 'value'], 'idx_mspri_sid_dom_value');
            $table->index(['siteid', 'domain', 'costs'], 'idx_mspri_sid_dom_costs');
            $table->index(['siteid', 'domain', 'rebate'], 'idx_mspri_sid_dom_rebate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_price');
    }
}
