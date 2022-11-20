<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopOrderBaseProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_order_base_product', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('baseid');
            $table->string('siteid');
            $table->bigInteger('ordprodid')->nullable();
            $table->bigInteger('ordaddrid')->nullable();
            $table->varbinary('type', 64);
            $table->varbinary('prodid', 36);
            $table->varbinary('prodcode', 64);
            $table->varbinary('stocktype', 64);
            $table->varbinary('supplierid', 36)->default('');
            $table->string('suppliername')->default('');
            $table->text('name');
            $table->text('description');
            $table->string('mediaurl')->default('');
            $table->string('target')->default('');
            $table->string('timeframe', 16)->default('');
            $table->double('quantity');
            $table->double('qtyopen')->default(0);
            $table->string('currencyid', 3);
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('costs', 12, 2);
            $table->decimal('rebate', 12, 2);
            $table->decimal('tax', 14, 4);
            $table->string('taxrate');
            $table->smallInteger('taxflag');
            $table->integer('flags');
            $table->integer('pos');
            $table->smallInteger('statuspayment')->nullable();
            $table->smallInteger('status')->nullable();
            $table->string('notes')->default('');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['baseid', 'pos'], 'unq_msordbapr_bid_pos');
            $table->index(['baseid', 'siteid', 'prodid'], 'idx_msordbapr_bid_sid_pid');
            $table->index(['baseid', 'siteid', 'prodcode'], 'idx_msordbapr_bid_sid_pcd');
            $table->index(['baseid', 'siteid', 'qtyopen'], 'idx_msordbapr_bid_sid_qtyo');
            $table->index(['ctime', 'siteid', 'prodid', 'baseid'], 'idx_msordbapr_ct_sid_pid_bid');
            $table->foreign('baseid', 'fk_msordbapr_baseid')->references('id')->on('mshop_order_base')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_order_base_product');
    }
}
