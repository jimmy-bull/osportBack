<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopOrderBaseCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_order_base_coupon', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('baseid');
            $table->string('siteid');
            $table->bigInteger('ordprodid')->nullable();
            $table->varbinary('code', 64);
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['baseid', 'siteid', 'code'], 'idx_msordbaco_bid_sid_code');
            $table->foreign('baseid', 'fk_msordbaco_baseid')->references('id')->on('mshop_order_base')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_order_base_coupon');
    }
}
