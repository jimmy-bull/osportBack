<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_subscription', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('siteid');
            $table->bigInteger('baseid');
            $table->bigInteger('ordprodid');
            $table->date('next')->nullable();
            $table->date('end')->nullable();
            $table->varbinary('productid', 36)->default('');
            $table->string('interval', 32);
            $table->smallInteger('reason')->nullable();
            $table->smallInteger('period')->default(0);
            $table->smallInteger('status')->default(0);
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['siteid', 'next', 'status'], 'idx_mssub_sid_next_stat');
            $table->index(['siteid', 'baseid'], 'idx_mssub_sid_baseid');
            $table->index(['siteid', 'ordprodid'], 'idx_mssub_sid_opid');
            $table->index(['siteid', 'productid', 'period'], 'idx_mssub_sid_pid_period');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_subscription');
    }
}
