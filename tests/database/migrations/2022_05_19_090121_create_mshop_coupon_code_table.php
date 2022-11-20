<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopCouponCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_coupon_code', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parentid');
            $table->string('siteid');
            $table->varbinary('code', 64);
            $table->integer('count')->default(0);
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->varbinary('ref', 36);
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'code'], 'unq_mscouco_sid_code');
            $table->index(['siteid', 'count', 'start', 'end'], 'idx_mscouco_sid_ct_start_end');
            $table->index(['siteid', 'start'], 'idx_mscouco_sid_start');
            $table->index(['siteid', 'end'], 'idx_mscouco_sid_end');
            $table->foreign('parentid', 'fk_mscouco_pid')->references('id')->on('mshop_coupon')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_coupon_code');
    }
}
