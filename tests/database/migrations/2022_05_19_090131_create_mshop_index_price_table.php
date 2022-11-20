<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopIndexPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_index_price', function (Blueprint $table) {
            $table->integer('prodid');
            $table->string('siteid');
            $table->string('currencyid', 3);
            $table->decimal('value', 12, 2)->nullable();
            $table->dateTime('mtime');
            
            $table->unique(['prodid', 'siteid', 'currencyid'], 'unq_msindpr_pid_sid_cid');
            $table->index(['siteid', 'currencyid', 'value'], 'idx_msindpr_sid_cid_val');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_index_price');
    }
}
