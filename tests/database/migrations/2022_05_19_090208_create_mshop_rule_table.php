<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_rule', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->varbinary('type', 64);
            $table->string('label');
            $table->string('provider');
            $table->text('config');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->integer('pos');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['siteid', 'provider'], 'idx_msrul_sid_prov');
            $table->index(['siteid', 'status'], 'idx_msrul_sid_status');
            $table->index(['siteid', 'label'], 'idx_msrul_sid_label');
            $table->index(['siteid', 'pos'], 'idx_msrul_sid_pos');
            $table->index(['siteid', 'start'], 'idx_msrul_sid_start');
            $table->index(['siteid', 'end'], 'idx_msrul_sid_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_rule');
    }
}
