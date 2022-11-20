<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_coupon', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->string('label');
            $table->string('provider');
            $table->text('config');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['siteid', 'status', 'start', 'end'], 'idx_mscou_sid_stat_start_end');
            $table->index(['siteid', 'provider'], 'idx_mscou_sid_provider');
            $table->index(['siteid', 'label'], 'idx_mscou_sid_label');
            $table->index(['siteid', 'start'], 'idx_mscou_sid_start');
            $table->index(['siteid', 'end'], 'idx_mscou_sid_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_coupon');
    }
}
